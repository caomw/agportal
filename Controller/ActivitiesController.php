<?php 
/**
 * This class controlls the actions on Activities
 *  
 **/

class ActivitiesController extends AppController{

/**
 * returns the activity with the given idea
 **/

public function view($id){

	$this->autoRender = false;
	if(!$id) {
		throw new NotFoundException(__('Invalid Activity'));
	}
	$activity = $this->Activity->findById($id);
	if(!$activity) {
		throw new NotFoundException(__('Invalid aactivity'));
	}
	return $activity;
}

/**
 * deletes the activity with the id in request->data from database
 **/

public function delete(){

	if($this->request->is('post')){
		$this->autoRender = false;
		$id=$this->request->data['Activity']['id'];
		if($id!=""){
			$this->Activity->delete($id);
		}
	}
}
/**
 *	adds a new activity to the database or updates an existing one and returns the id! 
 * 
 **/
public function add(){
	if($this->request->is('post')){
		$this->autoRender = false;
		$id=$this->request->data['Activity']['id'];
		if($id==""){
			$graph=$this->Session->read('Graph');
			$this->request->data['Activity']['graph_id']=$graph['Graph']['id'];
			$this->Activity->save($this->request->data);
			return $this->Activity->id;
		}else{
			$this->Activity->id = $id;
			$this->Activity->save($this->request->data);
			return $id;
		}

	}
}
}
?>