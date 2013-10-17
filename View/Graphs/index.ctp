<h1>All Graphs</h1>

<table>
	<tr><th>Id</th>
		<th>Name</th>
		<th>Created By</th>
		<th>Last Modified</th>
	</tr>


	<?php foreach ($graphs as $graph):?>
	<tr>
		<td><?php  echo $graph['Graph']['id']
		?></td>
		<td><?php 

		echo $this->Html->link($graph['Graph']['name'],
			'#',array('onclick'=>'if(!window.opener.closed){window.opener.openGraph('.$graph['Graph']['id'].');}')); 
			?>

		</td>

		<td><?php  echo $graph['User']['email'];
		?></td>

		<td><?php  echo $graph['Graph']['modified'];
		?></td>



	</tr>
	

<?php endforeach?>
</table>