<?php
echo $this->Html->css('font-awesome.min',null,array('inline'=>false));
echo $this->Html->script(
	'https://code.jquery.com/jquery-1.9.1.min.js',
	array('inline'=>false));
echo $this->Html->script(
	'jquery.slides',
	array('inline'=>false));
	?>
	<!-- SlidesJS Required: Start Slides Examples of the graphs drawn-->
	<!-- The container is used to define the width of the slide-->
	<div class="container">
		<div id="slides">
			<?php 
			echo $this->Html->image('example0.png',array('alt'=>'sample'));
			echo $this->Html->image('example1.png',array('alt'=>'standard-lecture'));
			echo $this->Html->image('example2.png',array('alt'=>'clickers-lectures'));
			echo $this->Html->image('example3.png',array('alt'=>'argue-graph'));
			echo $this->Html->image('example4.png',array('alt'=>'dataflow'));
			echo $this->Html->image('example5.png',array('alt'=>'iteration'));
			echo $this->Html->image('example6.png',array('alt'=>'group-levels'));
			echo $this->Html->image('jigsaw.png',array('alt'=>'jigsaw'));
			echo $this->Html->image('silentCollaboration.png',array('alt'=>'silentCollaboration'));
			echo $this->Html->image('distributedSimulation.png',array('alt'=>'distributedSimulation'));
			echo $this->Html->image('concurrentEngineering.png',array('alt'=>'concurrentEngineering'));
			echo $this->Html->image('coordinatingSubprojects.png',array('alt'=>'coordinatingSubprojects'));
			echo $this->Html->image('conceptGrid.png',array('alt'=>'conceptGrid'));
			echo $this->Html->image('interdependencies.png',array('alt'=>'interdependencies'));

			?>
			<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
			<a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>

		</div>
	</div>
	<!-- End SlidesJS Required: Start Slides -->





<div id="explore">
	<h2>Recently Added Graphs</h2>
	<!-- All I want to do is just having the first 6 ones here!!-->
	<table>
		<tr>
			<th>Name</th>
			<th>Created By</th>

		</tr>


		<?php foreach ($graphs as $graph):?>
		<tr>
			<td><?php 

			echo $this->Html->link($graph['Graph']['name'],
				array('controller' => 'users', 'action' => 'editor', $graph['Graph']['id'])); 
				?>

			</td>

			<td><?php  echo $graph['User']['name'];
			?></td>

		</tr>


	<?php endforeach?>
</table>

<?php
echo $this->Html->link("Explore All Shared Graphs",array("controller"=>"graphs","action"=>"shared"));

?>
</div>

<!-- if a user is signed in, I want to show something else here -->
<!-- start if -->
<?php 		
if (!$this->Session->check('User')) {

	?>
	<div id="signup">
		
		<h2>Sign Up</h2>

		<?php 
		echo $this->Form->create($model='User',array('action' => 'add' 
			, 'id' => 'signup_form'));
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->end('Sign Up');
		?>

	</div>
	<?php
}else{


	?>
	<div id="online">
		
		<h2>Online Users</h2>

		<table>
			<tr>
				<th>Name</th>
			</tr>


			<?php foreach ($onlines as $online):?>
			<tr>
				<td><?php 

				echo $this->Html->link($online['User']['name'],
					array('controller' => 'users', 'action' => 'view', $online['User']['id'])); 
					?>

				</td>


			</tr>


		<?php endforeach?>
	</table>

</div>


<?php
}
?>
<!-- end if -->
<div>
	<b>Description:</b>
	This website provides a tool for pedagogical scientists to draw activity graphs easily by using a graphical user interface. The activity graph can then be converted to an XML description or it can be shared with other scientists. For more information about the activity graph and its applications you can read the paper
	<a href="#"> here</a>.
	<br/>
	<br/>
	<br/>
	
</div>
<!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
<script>
$(function() {
	$('#slides').slidesjs({
		width: 940,
		height: 528,
		navigation: false,
	});
});
</script>
  <!-- End SlidesJS Required -->