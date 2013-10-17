<?php 
/**
 * compares the creation time of 2 messages
 **/ 
function cmp($a, $b) {
 $ad = new DateTime($a['created']);
 $bd = new DateTime($b['created']);
 if ($ad == $bd) {
  return 0;
}

return ($ad < $bd) ? 1 : -1;
}
/**
 * represents the users
 **/ 
class UsersController extends AppController{
	public $components = array('ImageUploader');

  /**
   * sets all the messages of this user( sent ore received) in a sorted way
   **/ 
  public function mailbox($id){
    if($this->Session->check('User')){
      $user = $this->User->findById($id);
  //merge $user['sent'], user['received'], add the sent flag va sort
      $messages=array();
      foreach($user['SentMessage'] as $sent){
        $sent['sent']=1;
    //add to array
        $receiver = $this->User->findById($sent['to_id']);
        $sent['to_name']=$receiver['User']['name'];
        array_push($messages,$sent);
      }

      foreach($user['ReceivedMessage'] as $received){
        $received['sent']=0;
        $sender = $this->User->findById($received['from_id']);
        $received['from_name']=$sender['User']['name'];
        array_push($messages,$received);
      }

      uasort($messages, 'cmp');
      $this->set("messages",$messages);
    }
  }

  /**
   * uploads the profile picture
   **/ 
  public function picture($data){
    App::uses('Sanitize', 'Utility');

    $output= array();  
    $data=Sanitize::clean($data);

    $file = $data['file']['image'];

  //the folder where the files will be stored
    $fileDestination = 'files';

  //the folder where the thumbnails will be saved (files/thumbnails/)
    $thumbnailDestination = $fileDestination.'/thumbnails/';

  /*
   * 
   * this is an array of options that can be passed to the 
   * ImageUploader function upload($formData, $path=null,$options=array('custom_name'=>null, 'thumbnail'=>null, 'max_width'=>null))
   * 
   * 
   * where $formData is the uploaded file, $path is the path where the file will be saved,
   * and options are available when uploading the image 
   * $options('thumbnail'=>array("max_width"=>'width_for_thumbnail',"max_height"=>'height_for_thumbnail', "path"=>'file/path/for/thumbnail/', "custom_name"=>'custom_name_for_the_thumbnail')
   *          'max_width'=>
   *          'custom_name'=>)
   * Where thumbnail is to create a thumbnail of the image when uploaded, 
   * max_width is to rescale the picture with a specific width,
   * custom_name is a custom name for the uploaded image
   * 
   * If you don't want to use options and simply upload the image just call the upload function without the options' array
   * 
   */   
  $options = array('thumbnail'=>array("max_width"=>180,
    "max_height"=>100, 
    "path"=>$thumbnailDestination),
  'max_width'=>700);    
  try{
        //this is where the magic happens we call the function upload using the imageuploader component 
    $output = $this->ImageUploader->upload($file,$fileDestination,$options);

  }catch(Exception $e){

    $output = array('bool'=>FALSE,'error_message'=>$e->getMessage());

  }
  return $output;

}

/**
 * sets all the users
 **/ 
public function index(){
	$users=$this->User->find('all');
	$this->set("users",$users);
}
/**
 * sets the user with the given id
 **/ 
public function view($id=null){
  if (!$id) {
    throw new NotFoundException(__('Invalid User'));
  }

  $user = $this->User->findById($id);
  $this->set("user",$user);
  if (!$user) {
    throw new NotFoundException(__('Invalid User'));
  }
}
/**
 * updates the information of a user in the database
 **/ 

public function edit($id=null){
 if (!$id) {
  throw new NotFoundException(__('Invalid User'));
}

$user = $this->User->findById($id);
$this->set("user",$user);
if (!$user) {
  throw new NotFoundException(__('Invalid User'));
}
if ($this->request->is('post') || $this->request->is('put')) {
  $this->User->id = $id;
  $output=$this->picture($this->request->data);
  if($output['bool']==1){ //successfully uploaded
    $this->request->data['User']['picture']=$output['thumb_path'];
  }else{
    $this->request->data['User']['picture']=$user['User']['picture'];
  }

  if ($this->User->save($this->request->data)) {
    $this->Session->setFlash(__('Your profile has been updated.'));
  } else {
    $this->Session->setFlash(__('Unable to update your profile.'));
  }
  
  $user = $this->User->findById($id);
  $this->Session->write('User',$user);
  //$this->set('imgSrc',$user['User']['picture']);
  $this->redirect(array('controller'=>'home',
    'action' => 'index'
    ));
}

if (!$this->request->data) {
  $this->request->data = $user;
}
}
//NEVER USED
public function export(){
	
}
/**
 * adds a new user to the database
 **/ 
public function add(){
	if($this->request->is('post')){
		if(!$this->User->save($this->request->data)){
$this->Session->setFlash('Unable to sign-up!');
    }else{
      $this->Session->setFlash('Successfully Signed up!');
		$this->redirect(array('controller'=>'users',
      'action' => 'login'
      ));
    }
	}
}
public function message($id=null){
  //todo: user session sends to the id. add to messages
  //no better solution is to have a message entity and a form that automatically saves this!
  //on arrival u need to find it! 

}

/**
 * loads the editor with the given graohId or empty
 **/ 
public function editor($graphId=null){
	$this->Session->delete('Graph');
$user=$this->Session->read('User');
$ownerId=$user['User']['id'];
  
  if($graphId!=null){
  $this->loadModel('Graph');
  $graph=$this->Graph->findById($graphId);
  $ownerId=$graph['Graph']['user_id'];
}
$this->set("theGraphId",$graphId);
if($ownerId!=$user['User']['id']){
  $this->set("owner",false);
}else{
  $this->set("owner",true);
}
	
  
}

/**
 * logs out
 **/ 
public function logout(){

  if($this->Session->check('User')){
    $user = $this->Session->read('User');
    $user = $this->User->findById($user['User']['id']);
    $user['User']['online']=0;
    $this->User->save($user);
    $this->Session->delete('User');
  }
  $this->redirect(array(
    'controller' => 'home',
    'action' => 'index'
    ));
}
/**
 * logs in :D
 **/ 
public function login(){
	if($this->request->is('post')){

	/*	//1. find method with 2 conditions
		$user=$this->User->find('first', array(
			'conditions' =>   array(
				'email' => $this->request->data('User.email'), 
					'password'=>$this->request->data('User.password')
				) 

			));
debug($user);*/
		//2. magical find
$user=$this->User->findByEmailAndPassword($this->request->data('User.email'),$this->request->data('User.password'));
if($user){
      //save as online
  $user['User']['online']=1;
  $this->User->save($user);

  $this->Session->write('User',$user);
  $this->redirect( array(
    'controller' => 'home',
    'action' => 'index' 
    ));
}
$this->Session->setFlash('Email and password combination is not correct.');
}
}

}
?>
