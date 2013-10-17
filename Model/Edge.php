<?php 

class Edge extends AppModel{

  public $belongsTo = array(
        'Graph',
        'From' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'from_id'
        ),
        'To' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'to_id'
        )
    );
	
}

 ?>