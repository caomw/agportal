<nav id="ex_navbar">
    <ul>
        <li>

        	<?php 
        	 echo $this->Html->link('Open','#',array('onclick'=>'openPopUp()'));
			?>
        </li>
        <li><a onclick="saveAll()">Save</a></li>
        <li>

<?php 
        echo $this->Html->link('Print','#',array('onclick'=>'printDiv("editor")'));
 // echo $this->Html->link('Export','#',array("controller" => "graphs",
 //    "action" => "xml"));
?>
        	</li>
        <li>
<?php 
        	         	 echo $this->Html->link('Share','#',array('onclick'=>'sharePopUp()'));
			?>
        </li>

    </ul>
</nav>
<div align="center">
<div class='flash' id="info"> Information message!</div>
</div>
<?php
echo $this->Html->css('jquery.ui.all',null,array('inline'=>false));
echo $this->Html->css('colorPicker',null,array('inline'=>false));
echo $this->Html->script(
    'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js',
   array('inline'=>false));
echo $this->Html->script(
    'jquery.dd',
   array('inline'=>false));

echo $this->Html->script(
    'jquery.ui.core',
   array('inline'=>false));
echo $this->Html->script(
    'jquery.ui.widget',
   array('inline'=>false));
echo $this->Html->script(
    'jquery.ui.tabs',
   array('inline'=>false));

echo $this->Html->script(
    'jquery-ui-1.8.9',
   array('inline'=>false));
echo $this->Html->script(
    'jquery.colorPicker',
   array('inline'=>false));

echo $this->Html->script(
    'jquery.layout-1.3.0',
   array('inline'=>false));
echo $this->Html->script(
    'jquery.jsPlumb-1.4.1-all',
   array('inline'=>false));
echo $this->Html->script(
    'raphael',
   array('inline'=>false));

echo $this->Html->script(
    'rgbcolor',
   array('inline'=>false));
echo $this->Html->script(
    'canvg',
   array('inline'=>false));

echo $this->Html->script(
    'raphael.backward-forward',
   array('inline'=>false));
//FARZANEH
echo $this->Html->script(
    'vars',
   array('inline'=>false));
echo $this->Html->script(
    'tabs',
   array('inline'=>false));
echo $this->Html->script(
    'line',
   array('inline'=>false));
echo $this->Html->script(
    'initialize',
   array('inline'=>false));
echo $this->Html->script(
    'edge',
   array('inline'=>false));
echo $this->Html->script(
    'activity',
   array('inline'=>false));
echo $this->Html->script(
    'open',
   array('inline'=>false));

echo $this->Html->script(
    'share',
   array('inline'=>false));

echo $this->Html->script(
    'coordinates',
   array('inline'=>false));
echo $this->Html->script(
    'main',
   array('inline'=>false));
echo $this->Html->script(
    'geometry',
   array('inline'=>false));
echo $this->Html->script(
    'loop',
   array('inline'=>false));
//CSS
echo $this->Html->css('dd',null,array('inline'=>false));
//FARZANEH CSS
echo $this->Html->css('main',null,array('inline'=>false));
echo $this->Html->css('normalize',null,array('inline'=>false));
echo $this->Html->css('print',null,array('inline'=>false,'media'=>'print'));
 ?>
<div id='innerBody'>
<!-- <iframe name=print_frame width=0 height=0 frameborder=0 src=about:blank></iframe> -->
		<!-- center section -->
		<div class="ui-layout-center" id="editor-center">
			<!-- tabs inside the center section-->
			<div id="tabs">
				<ul>
					<li>
						<a href="#editor">Graph</a>
					</li>
					<li>
						<?php  
						echo $this->Html->link('XML',array('controller' => 'graphs',
						 'action' => 'xml'),array('onclick'=>'loadXML()'));
						?>
						<!-- <a href="#xml">XML</a> -->
					</li>
				</ul>
				<!-- editor tab -->
				<div id="editor">

				</div>
				
				<!-- XML tab -->
				<!-- DO you want to add a save button? -->
			</div>

		</div>

		<!-- east section - Toolbox - Properties -->
		<div class="ui-layout-east" id="east-panel">
			<!-- The pallet, such a simple empty one -->
			<div class="ui-layout-north" id="east-north">
			<!-- <div id="graph-tabs">
					<ul>
						<li>
							<a href="#graph">Graph</a>
						</li>
					</ul>

					<div id="graph">
						<form>
							<fieldset> -->

								Graph Name:
								<input type="text" id="graphName" style="width: 200px; margin-top: 10px; margin-bottom: 10px; " value="My Graph"/>
							<!-- </fieldset>
						</form>
					</div>
				</div> -->
			</div>


			<div class="ui-layout-center" id="east-center">

				<div id="pallet-tabs">
					<ul>
						<li>
							<a href="#pallet">ToolBox</a>
						</li>
					</ul>

					<div id="pallet">
						<?php 
						
						echo $this->Html->image('activity.icon.png', array('alt' => 'activity',
							'onclick' => 'newAct()',
							'class' => 'hand',
							'title' => 'click to add an activity'
							));
					echo $this->Html->image('edge.icon.jpg', array('alt' => 'edge',
							'class' => 'hand',
							'onclick' => 'setFlash("edge")',
							'title' => 'right click on the source and destination to draw an edge'
							));
						echo $this->Html->image('loop.icon.png', array('alt' => 'loop',
							'onclick' => 'newLoop()',
							'class' => 'hand',
							'title' => 'click to activate loop mode'
							));
						echo $this->Html->image('hierarchy.icon.jpg', array('alt' => 'hierarchy',
							'onclick' => 'newHierarchy()',
							'class' => 'hand',
							'title' => 'click to activate draw upperlevel parallel activity'
							));
						?>
					
					</div>
				</div>
			</div>
			<!-- activity properties: maybe we have to make it dynamic? sometimes activities and sometimes links? -->
			<div class="ui-layout-south" id="east-south">
				<div id="prop-tabs">
					<ul id="prop-list">
						<li id="activity-prop-tab">
							<a  href="#activity-prop">Activity</a>
						</li>
						<li id="edge-prop-tab">
							<a  href="#edge-prop"> Edge</a>
						</li>
						<li id="loop-prop-tab">
							<a  href="#loop-prop"> Loop</a>
						</li>
					</ul>

					<div id="activity-prop">
						<form>
							<fieldset>

								Name:
								<input type="text" id="activityName" style="width: 200px; margin-top: 10px; margin-bottom: 10px; "/>
								<br/>
								Type:
								<select title="type" id="activityType" style="width: 200px; margin-top: 10px; margin-bottom: 10px;">
									<option value="reproduction"> Reproduction</option>
									<option value="conceptualization"> Conceptualization</option>
									<option value="application"> Application</option>
									<option value="exploration"> Exploration</option>
									<option value="mobilisation"> Mobilisation</option>
									<option value="problemSolving"> Problem Solving</option>

								</select>
								
								Split into:
								
								<select title="split" id="activitySplit" style="width: 200px; margin-top: 10px; margin-bottom: 10px;">
									<option value="1"> 1</option>
									<option value="2"> 2</option>
									<option value="3"> 3</option>
									<option value="4"> 4</option>
									<option value="5"> &gt;4</option>

								</select>
								
								<br/>
								Color(&beta;):
								<input id="color" name="color" type="text" value="#333399" />
							</fieldset>
						</form>
						
							
					</div>
					
					<div id="edge-prop">
						<form>
							<fieldset>

								
								Strength:
									<select title="strength" id="edge-strength" style="width: 200px; margin-top: 10px; margin-bottom: 10px;">
									<option value="1" data-image="../img/edge-strength-1.png"> </option>
									<option value="2" data-image="../img/edge-strength-2.png"> </option>
									<option value="3" data-image="../img/edge-strength-3.png"> </option>
									<option value="4" data-image="../img/edge-strength-4.png"> </option>
									</select>
									<br/>
									Operator:
									<select title="operator" id="edge-operator" style="width: 200px; margin-top: 10px; margin-bottom: 10px;">
									<option value="" > - </option>
									<option value="aggregation" data-image="../img/aggregation.png"> Aggregation</option>
									<option value="distribution" data-image="../img/distribution.png"> Distribution</option>
									<option value="decision" data-image="../img/decision.png">Decision </option>
									<option value="group" data-image="../img/group.png"> Group Formation</option>
									<option value="rotation" data-image="../img/rotation.png"> Role Rotation </option>
									<option value="evaluation" data-image="../img/evaluation.png"> Evaluation </option>
									</select>
									
									Fiber:
								<select title="fiber" id="edge-fiber" data-enablecheckbox="true" style="width: 200px; margin-top: 10px; margin-bottom: 10px;" >
									<option value=""> - </option>
									<option value="preRequisites"> Pre-requisites</option>
									<option value="advanceOrganizer"> Advance organizer</option>
									<option value="didacticElicitation"> Didactic elicitation</option>
									<option value="motivational"> Motivational</option>
									<option value="logistics"> Logistics</option>
									<option value="dataFlow"> DataFlow</option>

								</select>
									
									
							</fieldset>
						</form>
					</div>
				

				<div id="loop-prop">
						<form>
							<fieldset>

								Repeat:
								<input type="text" id="loop-repeat" style="width: 200px; margin-top: 10px; margin-bottom: 10px; "/>

								<br/>
									
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
<!-- necessary variables for JS files -->
<script type="text/javascript">

var graphUrl = '<?php echo Router::url(array(
    "controller" => "graphs",
    "action" => "add"))?>';

var activityUrl = '<?php echo Router::url(array(
    "controller" => "activities",
    "action" => "add"))?>';
var activityDeleteUrl='<?php echo Router::url(array(
    "controller" => "activities",
    "action" => "delete"))?>';

var edgeDeleteUrl='<?php echo Router::url(array(
    "controller" => "edges",
    "action" => "delete"))?>';


var loopDeleteUrl='<?php echo Router::url(array(
    "controller" => "loops",
    "action" => "delete"))?>';


var edgeUrl = '<?php echo Router::url(array(
    "controller" => "edges",
    "action" => "add"))?>';

var loopUrl = '<?php echo Router::url(array(
    "controller" => "loops",
    "action" => "add"))?>';

var openUrl='<?php echo Router::url(array(
    "controller" => "graphs",
    "action" => "user"))?>';

var messageUrl='<?php echo Router::url(array(
    "controller" => "messages",
    "action" => "add"))?>';

var exportUrl='<?php echo Router::url(array(
    "controller" => "users",
    "action" => "export"))?>';

var loadGraphUrl='<?php echo Router::url(array(
    "controller" => "graphs",
    "action" => "view"))?>';

var redirectedGraphId= '<?php echo $theGraphId;?>';
var owner= '<?php echo $owner;?>';

var viewLink = '<?php echo $this->Html->link("here",array("controller"=>"users","action"=>"editor"));?>';
var webRoot='<?php echo $this->webroot; ?>';


</script>



