<?php 
$bolDevelop = true; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic,600italic&subset=latin,latin-ext">
        
        <?php 
        if($bolDevelop === true) {
            App::import('Vendor', 'lessc');
            $less = new lessc;
            $less->compileFile('css/less/bootstrap.less', 'css/bootstrap.css');
        }
        echo $this->Html->css('bootstrap');
        echo $this->Html->script(array('jquery', 'jquery.ui', 'jquery.placeholder', 'jquery.typewatch', 'bootstrap'));
        
        // <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        // <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        
        // <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        
        // <script src="http://rawgithub.com/mathiasbynens/jquery-placeholder/master/jquery.placeholder.js"></script>
        // <script src="https://rawgithub.com/dennyferra/TypeWatch/master/jquery.typewatch.js"></script>
        
        // <script>$(function() { $('input, textarea').placeholder();});</script>
        
        echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
    </head>
    
    <body>
        <div class="container">
            <?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
        </div>
    </body>
</html>