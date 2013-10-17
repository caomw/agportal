<?php 
class Graph extends AppModel{


 public $belongsTo = array(
        'User'
    );
 public $hasMany = array(
       'Activity' => array(
            'className'  => 'Activity',
        ),
       'Edge',
       'Loop'       
    );
	public $validate=array(
		

'name' => array(
'rule' => 'notEmpty',
	)
		);
}

 ?>