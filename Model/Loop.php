<?php 

class Loop extends AppModel{


  public $belongsTo = array(
        'Graph',
        'Start' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'start_id'
        ),
        'End' => array(
            'className'    => 'Activity',
            'foreignKey'   => 'end_id'
        )
    );
	
}

 ?>