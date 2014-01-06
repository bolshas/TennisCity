<?php echo $this->Html->script('users/add_friend', array('inline' => false)); ?>

<div class="row">

    <div class="col-sm-4 listItem">
        <div class="listContent">
            <strong><?php echo $loggedIn['User']['username'] ?></strong>
            Friends <?php echo count($friends); ?>
        </div>
    </div>
    <div class="col-sm-8">
    <?php
    $i = 0;
    $cols = 1;
    
    foreach ($users as $user):
    ?>
            <div class="listItem col-sm-12">
    		    <?php echo $this->Html->image('faces/' . $user['Profile']['photo'], array('class' => 'userPhoto'))?>
    		    <span class="title text-primary">
    		    	<?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])) ?>
    		    </span>
    			<div class="listItem-footer">
        			<ul class="actions">
        				<li><small class="action-text"><span class="glyphicon glyphicon-asterisk"></span> Challenge</small></li>
        				<li><small class="action-text addFriend" id="<?php echo $user['User']['id']?>"><span class="glyphicon glyphicon-plus"></span> Add friend</small></li>
        				<li><small class="action-text"><span class="glyphicon glyphicon-pencil"></span> Send message</small></li>
        			</ul>
    			</div>
            </div>
    <?php 
    $i++;
    unset($user);
    endforeach;
    
    echo $this->BSpaginator->BSNumbers() . '</div></div>';