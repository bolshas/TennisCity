<?php 
 	echo $this->Form->create('User', array(
 	    'role' => 'form',
 	    'autocomplete' => 'off',
 	    'inputDefaults' => array('label' => false, 'div' => false, 'required' => false)));
?>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
    	    <h1>Login to your <strong>Tennis City</strong> account</h1>
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
            <label for="UserPassword" class="control-label col-sm-offset-4 col-sm-4">Your password</label>
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <?php echo $this->Form->input('password', array('placeHolder'=>'Password', 'class' => 'form-control input-lg validate'));?>
            </div>
            <div class="col-sm-4 UserPassword help-block">&nbsp</div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="checkbox">
                    <label><?php echo $this->Form->checkbox('remember_me'); ?> Remember me</label>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <?php echo $this->Form->end(array('label' => 'Login', 'class' => 'btn btn-lg btn-primary')); ?>
        </div>
	</div>
	<div class="row">
	    <div class="col-sm-offset-4 col-sm-4">
	        <p>
	            If you do not have an account, please create one <?php echo $this->Html->link('here', array('controller' => 'pages', 'action' => 'home'));?>
	        </p>
	    </div>
	</div>