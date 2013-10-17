<?php 		
//in header for showing the menu or login input
if ($this->Session->check('User')) {
	$session=$this->Session->read('User');
	$user=$session['User'];
	echo $this->Html->link(
		'Home | ',
		array('controller' => 'home', 'action' => 'index')
		);
	echo $this->Html->link('Mailbox | ',
		array('controller' => 'users', 'action' => 'mailbox', $user['id'])); 

	echo $this->Html->link(
		'Editor | ',
		array('controller' => 'users', 'action' => 'editor')
		);
	echo $this->HTML->link('logout', array('controller' => 'users' , 'action' => 'logout' )).'|';

	echo $this->HTML->link($user['email'], array('controller' => 'users' , 'action' => 'edit',$user['id'] ));
	?>
	<img id="avatarIcon" src=<?php echo $this->webroot.$user['picture'];?>>
	<?php
}else{
	echo $this->Form->create($model='User',array('action' => 'login', 'id' => 'login_form', 
		'inputDefaults'=>array('div'=>false, 'label'=>false)));
		?>
		<table>
			<tr>
				<td><?php echo $this->Form->label('email'); ?></td>
				<td><?php echo $this->Form->label('password'); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('email'); ?></td>
				<td><?php echo $this->Form->input('password'); ?></td>
				<td><?php echo $this->Form->end('Log In',array('div'=>false)); ?></td>
			</tr>
		</table>
		<?php
	} 
	?>