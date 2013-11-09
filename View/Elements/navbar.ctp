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
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	        <?php
	        if ($this->Session->read('Auth.User')) {
	            echo '<li class="dropdown">';
	            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $this->Session->read('Auth.User.username') . '<b class="caret"></b></a>';
	            echo '<ul class="dropdown-menu">';
	            echo '<li><a href="#"><span class="glyphicon glyphicon-cog"></span>Account settings</a></li>';
	            echo '<li>' . 
	            		$this->Html->link('<span class="glyphicon glyphicon-log-out"></span>Sign out', 
	            		array('controller' => 'users', 'action' => 'logout'),
	            		array('escape' => false)) . 
	            	'</li>';
	            echo '</ul>';
	            echo '</li>';
	        }
	        else {
	            echo '<li><a href="#" data-toggle="modal" data-target="#myModal">Sign in</a></li>';
	        }
	        ?>
	    </ul>
	</div>
    </div>
</nav>