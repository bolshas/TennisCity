<?php 
$bolDevelop = true; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tennis City</title>
        
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
        
        echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
        <script>
        $(document).ready(function() {
            $('input:text:visible:first').focus();
            
            $("#myModal").on('shown.bs.modal', function() {
                $('#needsFocus').focus();
            });
         });
        </script>
    </head>
    
    <body>
        <?php
        echo $this->element('navbar');
        
        if (!@$this->params['pass'][0] == 'home') { // quick and dirty refactoring
            echo '<div class="container">';
            echo $this->fetch('content');
            echo '</div>';
        }
        else {
            echo $this->element('modal-signin');
            echo $this->fetch('content');
        }
        echo $this->Session->flash();
		?>
    </body>
</html>