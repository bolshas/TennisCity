<?php
	$this->Html->script('ajax_validate', array('inline' => false));
    
 	echo $this->Form->create('User', array(
 	    'controller' => 'users', 
 	    'action' => 'register', 
 	    'role' => 'form',
 	    'autocomplete' => 'off',
 	    'inputDefaults' => array('label' => false, 'div' => false, 'required' => false)));
 	echo "\n";
?>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
    	    <h1>Create your <strong>Tennis City</strong> account</h1>
    	</div>
	</div>
	<div class="form-group">
	    <div class="row">
	        <label for="UserUsername" class="control-label col-sm-offset-4 col-sm-4">Your real name</label>
	    </div>
	    <div class="row">
    	    <div class="col-sm-offset-4 col-sm-4"><?php echo $this->Form->input('username', array('placeHolder'=>'Username', 'class' => 'form-control input-lg validate'))?></div>
    	    <div class="col-sm-4 UserUsername help-block">&nbsp</div>
	    </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <label for="UserEmail" class="control-label col-sm-offset-4 col-sm-4">Your email address</label>
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <?php echo $this->Form->input('email', array('placeHolder'=>'Email', 'type' => 'text', 'class' => 'form-control input-lg validate'))?>
            </div>
            <div class="col-sm-4 UserEmail help-block">&nbsp</div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <label for="UserPassword" class="control-label col-sm-offset-4 col-sm-4">Choose a password</label>
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <?php echo $this->Form->input('password', array('placeHolder'=>'Password', 'class' => 'form-control input-lg validate'));?>
            </div>
            <div class="col-sm-4 UserPassword help-block">&nbsp</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <?php echo $this->Form->end(array('label' => 'Update', 'class' => 'btn btn-lg btn-primary')); ?>
        </div>
	</div>