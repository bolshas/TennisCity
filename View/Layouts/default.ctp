<?php
$cakeDescription = __d('cake_dev', 'Tennis City');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->meta('viewport', array('content' => 'width=device-width', 'initial-scale' => '1.0'));
		echo $this->Html->css('style');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic,600italic&subset=latin,latin-ext');
		echo $this->Html->script('http://code.jquery.com/jquery-1.9.1.js');
		echo $this->Html->script('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
        echo $this->Html->script('http://rawgithub.com/mathiasbynens/jquery-placeholder/master/jquery.placeholder.js');
        echo $this->Html->script('https://rawgithub.com/dennyferra/TypeWatch/master/jquery.typewatch.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
    ?>    
        <script>$(function() { $('input, textarea').placeholder();});</script>
</head>
<body>
	<div id="container">
		<div id="header">
            <ul>
                <li><a href="/TennisCity" class="active">Home</a></li>
                <li><a href="#">Players</a></li>
                <li><a href="#">Schedule</a></li>
            </ul>
			<?php
			if ($this->Session->read('Auth.User')) {
				echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
                $loggedInUser = $this->Session->read('Auth.User');
                echo __('Welcome, ' . $loggedInUser['username']);
			}
			else {
				echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
			}
			?>
		</div>
		<div class="content">
			<span id="tester"></span>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
