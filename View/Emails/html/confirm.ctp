<?php

$linkText = $this->Html->url(array('controller' => 'users', 'action' => 'confirm'), true);
$link = $this->Html->link('link', array('controller' => 'users', 'action' => 'confirm', $validation, 'full_base' => true));

echo 'Please click this ' . $link . ' in order to activate your account or go to '. $linkText . ' and enter the following validation code: <b>' . $validation . '</b>';