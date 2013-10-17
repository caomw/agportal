<h1>Overview of all users</h1>

<table>
	<tr><th>Id</th>
		<th>Email</th>
		<th>Password</th>
	</tr>
	<?php foreach ($users as $user):?>
<tr>
	<td><?php echo $user['User']['id']; ?></td>
	<td><?php echo $user['User']['email']; ?></td>
	<td><?php echo $user['User']['password']; ?></td>
</tr>
	

<?php endforeach?>
</table>