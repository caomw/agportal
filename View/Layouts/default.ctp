<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?> </title>
<?php 
		echo $this->Html->css('cake.generic');

echo $this->Html->css(array('layout'));
 echo $this->Html->css('styles');
  echo $scripts_for_layout;
?>
</head>
<body>
	
<header id="header">
<?php
	echo $this->Html->link(
    'Activity Graph Editor',
    array('controller' => 'home', 'action' => 'index'),
    array('id'=>'logo')
);
?>
    <div id="login_container">
    	<!-- It might be a form for login or the username + log-out link-->
    	<?php
	echo $this->element('login');
    	 ?>
    </div>
</header>
<div id="body">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
</div>
<footer id="footer">
	
	<?php  echo $this->HTML->link('CHILI','http://chili.epfl.ch/');?>
</footer>
</body>
</html>
