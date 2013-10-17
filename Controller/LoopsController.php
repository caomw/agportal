<?php 
/**
 * representing loops
 **/
class LoopsController extends AppController{
	
	/**
	 * finds all the loops in the database <<NEVER USED>>
	 **/ 
	public function view(){
		$this->autoRender = false;
		$loops=$this->Loop->find('all');
		pr($loops);
	}

	/**
	 * deletes the loops with the id in request->data from the database
	 **/ 	

	public function delete(){

		if($this->request->is('post')){
			$this->autoRender = false;
			$id=$this->request->data['Loop']['id'];
			if($id!=""){
				$this->Loop->delete($id);
			}
		}
		
	}
	/**
	 * Adds a loop to the database or updates an existing one
	 **/ 
	public function add(){
		if($this->request->is('post')){
			$this->autoRender = false;
			$id=$this->request->data['Loop']['id'];
			//pr($this->request->data['Activity']);
			if($id==""){
				$graph=$this->Session->read('Graph');
				$this->request->data['Loop']['graph_id']=$graph['Graph']['id'];
				$this->Loop->save($this->request->data);
				return $this->Loop->id;
			}else{
				$this->Loop->id = $id;
				$this->Loop->save($this->request->data);
				return $id;
			}
		}
	}
}
?>