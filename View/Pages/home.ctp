<?php
// 	$this->Html->script('ajax_validate', array('inline' => false));
?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1><?php echo __('Find Your <strong>Tennis</strong> Partner Online');?></h1>
            </div>
            <div class="col-sm-4">
                <h4><?php echo __('<strong>Sign up</strong> for a free account');?></h4>
                <?php echo $this->Form->create('User', array('class' => 'validate', 'controller' => 'users', 'action' => 'register', 'role' => 'form', 'autocomplete' => 'off', 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false))); ?>
                <div class="form-group">
                    <?php echo $this->Form->input('username', array('placeHolder'=>'Username', 'class' => 'form-control validate input-lg'))?>
                    <div class="UserUsername help-block"></div>
                </div>
        
                <div class="form-group">
                    <?php echo $this->Form->input('email', array('placeHolder'=>'Email', 'type' => 'text', 'class' => 'form-control validate input-lg'))?>
                    <div class="UserEmail help-block"></div>
                </div>
        
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('placeHolder'=>'Password', 'class' => 'form-control validate input-lg'));?>
                    <div class="UserPassword help-block"></div>
                </div>
                <div class="form-group">
                <?php echo $this->Form->end(array('label' => 'Sign up', 'class' => 'btn btn-primary btn-lg')); ?>
                </div>
            </div>  
        </div>
    </div>
</div>