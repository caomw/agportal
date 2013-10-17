<h2>Messages
    <span class="khodaya">
    <?php
  echo $this->Html->image('write.png',array('alt'=>'sent','class'=>'icon'));
echo $this->Html->link("New",
array('controller' => 'messages', 'action' => 'add')); 
?>
</span>
</h2>
<h2>
</h2>
<table>
    <tr>
        <th> </th>
        <th>Subject</th>
        <th>Time</th>
    </tr>
    <!-- Here is where we loop through our $posts array, printing out post info -->
    <?php foreach ($messages as $message): ?>
    <tr>
        <td class="smallCell">
        <?php
        if($message['sent']==1){
            echo $this->Html->image('send.jpg',array('alt'=>'sent','class'=>'icon'));
        }else{
            echo $this->Html->image('receive.jpg',array('alt'=>'received','class'=>'icon'));
        }
        ?>
        

            <?php 
if($message['sent']==1){
           echo $this->Html->link($message['to_name'],
array('controller' => 'users', 'action' => 'view', $message['to_id'])); 
        }else{
            echo $this->Html->link($message['from_name'],
array('controller' => 'users', 'action' => 'view', $message['from_id'])); 
        }
?>

        </td>
        <td><?php echo $this->Html->link($message['subject'],
array('controller' => 'messages', 'action' => 'view', $message['id']));  ?></td>
        <td><?php echo $message['created']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
