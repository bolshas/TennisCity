<?php
App::uses('CakeTime', 'Utility');
?>
<div class="col-sm-2">
    <?php echo $this->Html->image('faces/' . $user['Profile']['photo'], array('class' => 'pull-left')) ?>
</div>
<div class="col-sm-4">
<h3><?php echo $user['User']['username']?></h3>
    <p><strong>Nationality: </strong><?php echo $this->Country->fullName($user['Profile']['country'])?></p> 
    <p><strong>Born: </strong><?php echo $this->Time->format('F jS, Y', $user['Profile']['born'])?></p>
    <p><strong>Started playing: </strong><?php echo CakeTime::timeAgoInWords($user['Profile']['started'], array('end' => '+100 years', 'accuracy' => array('year' => 'year')))?></p>
    <p><strong>Level: </strong><?php echo $user['Profile']['experience']?></p>
    <p><strong>Main hand: </strong><?php echo $user['Profile']['hand']?></p>
</div>

<div class="col-sm-4">
    <p><strong>Friends with</strong></p>
    <?php
    foreach ($friends as $friend):
    ?>
    <p><?php echo $this->Html->link($friend['username'], array('controller' => 'users', 'action' => 'view', $friend['id'])) ?></p>
    <?php
    unset($friend);
    endforeach;
    ?>
</div>
