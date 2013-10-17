<h1>Edit Profile</h1>
<?php
    echo $this->Form->create('User',array('enctype' => 'multipart/form-data'));
    ?>
    <img id="avatar" src=<?php echo $this->webroot.$user['User']['picture'];?>>
    <?php
     echo $this->Form->file('file.image');

    //echo $this->Form->input('email',array( 'disabled' => 'disabled' ));

    echo $this->Form->input('name');
    echo $this->Form->input('password');
    //label
    //show current image as well
//    echo $this->Html->image('picture');
    


   
    echo $this->Form->input('id', array('type' => 'hidden'));
    
    echo $this->Form->end('Update Profile');
    //echo $imgSrc;

?>
