<?php 
echo $this->Form->create('User', array('role' => 'form', 'autocomplete' => 'off', 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false)));
echo $this->Form->input('email', array('placeHolder'=>'Email', 'type' => 'text', 'class' => 'form-control'));
echo $this->Form->input('password', array('placeHolder'=>'Password', 'class' => 'form-control'));
?>
<div class="checkbox">
    <label><?php echo $this->Form->checkbox('remember_me'); ?> Remember me</label>
</div>
<p>
    If you do not have an account, please create one <?php echo $this->Html->link('here', array('controller' => 'pages', 'action' => 'home'));?>
</p>
