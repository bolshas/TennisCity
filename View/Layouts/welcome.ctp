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
        $(function ()  
        {
          $('#disclaimer').popover(
          {
             trigger: 'hover',
             html: true,
             placement: 'bottom',
             content: '<?php echo $this->element('test');?>'
          });
        });
        </script>
    </head>
    
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/TennisCity">Tennis City</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/TennisCity">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Blog</a></li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action 1</a></li>
                                <li><a href="#">Action 2</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" data-toggle="modal" data-target="#myModal" id="disclaimer">Sign in</a></li>
                    </ul>
                    
                </div>
            </div>
        </nav>
        <?php 
        echo $this->Session->flash('flash', array('element' => 'danger'));
		echo $this->fetch('content');
		echo $this->element('modal-signin');
		?>
    </body>
</html>