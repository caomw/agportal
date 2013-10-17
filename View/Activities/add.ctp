<!-- ONLY FOR DEBUGGING USAGE -->

<h2>Save Activity</h2>

<?php 
	echo $this->Form->create();
	echo $this->Form->input("graph_id");
	echo $this->Form->input("parent_id");
	echo $this->Form->input('name');
	echo $this->Form->input('type');
	echo $this->Form->input('betha');

	echo $this->Form->end('Save');
 ?>