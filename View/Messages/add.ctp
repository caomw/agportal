<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
echo $this->Form->create('Message');
echo $this->Form->input('to_id');
echo $this->Form->input('subject');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Send');
?>