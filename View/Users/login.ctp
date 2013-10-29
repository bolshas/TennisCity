<?php 
echo $this->Form->create('User');
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->checkbox('remember_me');
echo __('Remember me');
echo $this->Form->end(__('Login'));