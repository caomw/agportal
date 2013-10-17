
<!-- ONLY FOR DEBUGGING USAGE -->
<h2>Save Edge</h2>

<?php 
	echo $this->Form->create();
	echo $this->Form->input("from_id");
	echo $this->Form->input("to_id");
	echo $this->Form->input('strength');
	echo $this->Form->input('operator');
	echo $this->Form->input('fiber');

	echo $this->Form->end('Save');
 ?>