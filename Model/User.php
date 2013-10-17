<?php 
app::uses('Security','Utility');
class User extends AppModel{

	
public $hasMany = array(
        'Graph',
       'SentMessage' => array(
            'className'  => 'Message',
            'foreignKey' => 'from_id'
        ),
        'ReceivedMessage' => array(
            'className'    => 'Message',
            'foreignKey'   => 'to_id'
        ),
    );

public $validate = array(
'password' => array(
            'rule'    => array('between', '5','10'),
            'message' => 'Passwords must be between 5 and 10 characters long.'
        ),
        'email' => array(
            'rule'    => 'email',
            'message' => 'Please fill in a valid email address.'
        ),

 );

//TODO: password safety!! Save the Hash, check the hash!
// public function beforeSave($options=array()){
// $this->data['User']['password']=Security::hash( $this->data['User']['password'],'sha1',true);
// return true;
// }
}

 ?>