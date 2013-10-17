<?php 
/**
 * A simple one for just showing recently added graphs and online users
 **/
class HomeController extends AppController{
public function index(){
	//can I get recently added graphs and set them? I guess it should be possible!! J'espere
	$this->loadModel('Graph');
	$graphs=$this->Graph->find('all',array(
    'conditions' => array('public' => 1), //array of conditions
    'order' => array('Graph.created DESC'), //string or array defining order
    'limit' => 10, //int
));
	$this->set("graphs",$graphs);


$this->loadModel('User');
	$onlines=$this->User->find('all',array(
    'conditions' => array('online' => 1)
    ));
	$this->set("onlines",$onlines);
}
}

 ?>