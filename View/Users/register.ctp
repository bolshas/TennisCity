<?php 
	$this->Html->script('users/check_username', array('inline' => false));
?>

<div class="users form">
<?php 
echo $this->Form->create('User', array(
	'inputDefaults' => array(
		// 'div' => false,
		// 'label' => true
		)
	)
); 

?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        echo $this->Form->input('username');
        echo '<span id="username_ajax_result"></span>';
        echo $this->Form->input('email');        
        echo $this->Form->input('password');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));
