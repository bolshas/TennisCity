<?php 
echo $this->Form->create('User');
echo $this->Form->input('Profile.pro');
echo $this->Form->input('Profile.city');
echo $this->Form->end('Subit');