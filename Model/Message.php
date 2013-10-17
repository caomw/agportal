<?php 

class Message extends AppModel{


  public $belongsTo = array(
        'From' => array(
            'className'    => 'User',
            'foreignKey'   => 'from_id'
        ),
        'To' => array(
            'className'    => 'User',
            'foreignKey'   => 'to_id'
        )
    );
	
}

 ?>