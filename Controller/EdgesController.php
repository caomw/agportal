<?php 
/**
 * This class controlles the actions on Edges
 * 
 **/
class EdgesController extends AppController{
	
	/**
	 * returns the list of all edges in the database <<NEVER USED>>
	 **/

	public function view(){
		$this->autoRender = false;
		$edges=$this->Edge->find('all');
		return $edges;
	}

	/**
	 * deletes the edge with the id in request->data from the database
	 **/
	public function delete(){

		if($this->request->is('post')){
			$this->autoRender = false;
			$id=$this->request->data['Edge']['id'];
			if($id!=""){
				$this->Edge->delete($id);
			}
		}
		
	}
	/**
	 *  adds a new edge to the database or updates the existing one
	 **/
	public function add(){

		if($this->request->is('post')){
			$this->autoRender = false;
			$id=$this->request->data['Edge']['id'];
			if($id==""){
				$graph=$this->Session->read('Graph');
				$this->request->data['Edge']['graph_id']=$graph['Graph']['id'];
				$this->Edge->save($this->request->data);
				return $this->Edge->id;
			}else{
				$this->Edge->id = $id;
				$this->Edge->save($this->request->data);
				return $id;
			}

		}
	}
}
?>