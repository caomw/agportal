<h1>Profile</h1>

 <img id="avatar" src=<?php echo $this->webroot.$user['User']['picture'];?>>
 <table>
<tr>
<td>Name: </td>
<td><?php echo $user['User']['name'];?></td>
</tr>

<tr>
<td>Email: </td>
<td><?php echo $user['User']['email'];?></td>
</tr>

<tr>
<td>Member Since: </td>
<td><?php echo $user['User']['created'];?></td>
</tr>
</table>
