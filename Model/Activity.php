<?php 

class Activity extends AppModel{

//Parent for the case where the activity is splitted!
public $belongsTo = array(
        'Graph',
        'Parent' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'parent_id'
        ),
    );
//Children for when the activity is splitted! 
public $hasMany = array(
       'FromEdge' => array(
            'className'  => 'Edge',
            'foreignKey' => 'from_id'
        ),
        'ToEdge' => array(
            'className'    => 'Edge',
            'foreignKey'   => 'to_id'
        ),
        'Children' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'parent_id'
            )
    );
public $validate=array(

        'name' => array(
        'rule' => 'notEmpty',
        )
    );
}

 ?>