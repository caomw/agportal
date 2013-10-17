<?php
/**
 * represents messages
 **/ 
class MessagesController extends AppController{
	/**
	 * sets the message with the id
	 **/ 
	public function view($id){
		$message = $this->Message->findById($id);
$this->set('message',$message);
	}
	
	/**
	 * adds a new message to the database or updates an existing one
	 **/ 
	public function add(){
	$tos = $this->Message->To->find('list');
		$this->set(compact('tos'));
		if($this->request->is('post')){
			if($this->Session->check('User')){
				$user=$this->Session->read('User');
				$this->request->data['Message']['from_id']=$user['User']['id'];
				if ($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('Message Sent.'));
				} else {
					$this->Session->setFlash(__('Unable to send the message.'));
				}
				$this->redirect(array('controller'=>'users',
					'action'=>'mailbox'
					,$this->request->data['Message']['from_id']
					)); //that action requires the id of the user to be sent as well

			}

		}
	}
}

?>
