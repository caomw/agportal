<?php 
class GraphsController extends AppController{

	/**
 	* searches for an activity inside an array by its id and returns its name
 	**/
 	private function getActivityName($actId,$activities){

 		foreach($activities as $activity){
 			if($activity['id']==$actId){
 				return $activity['name'];
 			}
 		}
 		return "";
 	}

	//It is more logical to have this one in the ActivityController, but anyway c'est la vie :D
	/**
	 * returns the xml representation of an activity
	 **/ 

	private function activityXml($activity,$doc){
		$activityNode=$doc->createElement('activity');
		$activityNode->setAttribute("name",$activity['name']);
		$activityNode->setAttribute("start",$activity['x']);
		$activityNode->setAttribute("duration",$activity['duration']);
		$activityNode->setAttribute("betha",$activity['betha']);
		$activityNode->setAttribute("type",$activity['type']);
		$activityNode->setAttribute("social_plane",$activity['plane']);
		$activityNode->setAttribute("parallel",$activity['parallel']);
		$activityNode->setAttribute("upper",$activity['upper']);
		$activity=$this->Graph->Activity->findById($activity['id']);
  		//for all the children create the xml and add it //splited ones
		$children=$activity['Children'];
		$length=count($children);
		if($length!=0){
			$activityNode->setAttribute("splitted",$length);	
		}
		foreach($children as $child){
			$childNode=$this->activityXml($child,$doc);
			$activityNode->appendChild($childNode);
		}
		return $activityNode;
	}

	/**
	 * writes the XML representation of the whole graph in the session. remember that the graph
	 * should be saved before using the xml representation.
	 **/ 
	public function xml(){
		$this->layout=false;
		$this->autoRender = false; //alors, I do not need the xml.ctp anymore
		$graph = $this->Session->read('Graph');
		$graph=$this->Graph->findById($graph['Graph']['id']);
//not saved yet!
		if(count($graph)==0){
			echo "You need to save the graph first!";
		}else{
		$this->set("graph",$graph);
	//	$this->header('Content-Type: text/xml'); 
	//	$this->response->type('xml');
		$doc = new DOMDocument();
		$doc->formatOutput = true;
		//graph
		$graphNode = $doc->createElement( "activity_graph" );
		$graphNode->setAttribute("id",$graph['Graph']['id']);
		$graphNode->setAttribute("name",$graph['Graph']['name']);
		$graphNode->setAttribute("user",$graph['User']['email']);
		$graphNode->setAttribute("created",$graph['Graph']['created']);
		$graphNode->setAttribute("modified",$graph['Graph']['modified']);
		$doc->appendChild($graphNode);
		//activities
		$activitiesNode=$doc->createElement('activities');
		$graphNode->appendChild($activitiesNode);
		$activities=$graph['Activity'];
		foreach($activities as $activity){
			if($activity['parent_id']==null){
				$activitiesNode->appendChild($this->activityXml($activity,$doc));
			}
		}
		//edges
		$edgesNode=$doc->createElement('edges');
		$graphNode->appendChild($edgesNode);
		$edges=$graph['Edge'];
		foreach($edges as $edge){
			$EdgeNode=$doc->createElement('edge');
			$EdgeNode->setAttribute("strength",$edge['strength']);
			$EdgeNode->setAttribute("operator",$edge['operator']);
			$EdgeNode->setAttribute("fiber",$edge['fiber']);
			$from= $this->getActivityName($edge['from_id'],$activities);
			$EdgeNode->setAttribute("from",$from);
			$to= $this->getActivityName($edge['to_id'],$activities);
			$EdgeNode->setAttribute("to",$to);
			$edgesNode->appendChild($EdgeNode);
		}
		//loops
		$loopsNode=$doc->createElement('loops');
		$graphNode->appendChild($loopsNode);
		$loops=$graph['Loop'];
		foreach($loops as $loop){
			$loopNode=$doc->createElement('loop');
			$start= $this->getActivityName($loop['start_id'],$activities);
			$loopNode->setAttribute("start",$start);
			$end= $this->getActivityName($loop['end_id'],$activities);
			$loopNode->setAttribute("end",$end);
			$loopNode->setAttribute("repeat",$loop['repeat']);
			$loopsNode->appendChild($loopNode);
		}
	//these might be useful later
	//what I want to work on at the moment is graphical representation of the repeatation 
	//  $str=$doc->saveXML();
	//kinda stupid but voila!


		echo "<xmp>".$doc->saveXML()."</xmp>";
		}
  	//return $doc;
	}

	/**
	 * returns all the saved graphs
	 **/
	public function index(){
		// $this->set("graphs",$user['Graph']);
		$graphs=$this->Graph->find('all');
		//$graphs=$this->Graph->findAllByPublic(1);
		$this->set("graphs",$graphs);
	}
	/**
	 * sets the set of all public graphs
	 **/
	public function shared(){
		$graphs=$this->Graph->findAllByPublic(1);
		$this->set("graphs",$graphs);
	}
	/**
	 * sets the graphs created by this user
	 **/ 
	public function user(){
		$user=$this->Session->read('User');
		$graphs=$this->Graph->findAllByUserId($user['User']['id']);
		$this->set("graphs",$graphs);
	}
	/**
	 * returns the json form of the graoh with the id
	 **/

	public function view($id){

		$this->autoRender = false;

		if (!$id) {
			throw new NotFoundException(__('Invalid Graph'));
		}

		$graph = $this->Graph->findById($id);
		if (!$graph) {
			throw new NotFoundException(__('Invalid graph'));
		}
        //pr($graph);
        //$this->set('graph', $graph);
		$this->Session->write('Graph',$graph);
		return json_encode($graph);
	}
	/**
	 * adds a new graph to the database or updates an existing one. 
	 **/ 

	public function add(){
		$this->autoRender = false;
		
		if($this->request->is('post')){
			$id=$this->request->data['Graph']['id'];
			if($id==""){
				$user=$this->Session->read('User');
				$this->request->data['Graph']['user_id']=$user['User']['id'];
				$graph=$this->Graph->save($this->request->data);
				$this->Session->write('Graph',$graph);
				return $this->Graph->id;
			}else{
				$graph=$this->Graph->findById($id);
				$this->Graph->id = $graph['Graph']['id'];
				$this->Graph->saveField('name', $this->request->data['Graph']['name']);
				$this->Session->write('Graph',$graph);
				return $id;
			}

		}
	}
}
?>
