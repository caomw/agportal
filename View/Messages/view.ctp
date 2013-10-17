<h2>View Message</h2>

 <table>
<tr>
<td>From: </td>
<td><?php echo $message['From']['name'];?></td>
</tr>

<tr>
<td>To: </td>
<td><?php echo $message['To']['email'];?></td>
</tr>
<tr>
<td>Time: </td>
<td><?php echo $message['Message']['created'];?></td>
</tr>

<tr>
<td>Subject: </td>
<td><?php echo $message['Message']['subject'];?></td>
</tr>
<tr >
<td> </td>
<td class="messageBody"><?php echo $message['Message']['body'];?></td>
</tr>

</table>
<?php $user=($this->Session->read('User'));?>


<?php
if($user['User']['id']==$message['Message']['to_id']){
    echo $this->Form->create($model='Message',array('action' => 'add' ));
    ?>
	Reply:
    <?php
echo $this->Form->input('from_id', array('type' => 'hidden','default'=>$message['Message']['to_id']));
echo $this->Form->input('to_id', array('type' => 'hidden','default'=>$message['Message']['from_id']));
    echo $this->Form->input('subject',array('default'=>'Re:'.$message['Message']['subject']));
    echo $this->Form->input('body');
    echo $this->Form->end('Send');
}
?>
