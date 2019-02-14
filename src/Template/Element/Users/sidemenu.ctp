<?php
/**
 * Created by PhpStorm.
 * User: k_otsuka
 * Date: 2019-02-14
 * Time: 11:35
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <?php if (isset($user)) { ?>
        <li><?= $this->Html->link(__('Mypage'), ['action' => 'mypage']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['action' => 'logout']) ?></li>
        <?php } else { ?>
        <li><?= $this->Html->link(__('Signup'), ['action' => 'signup-register']) ?></li>
        <li><?= $this->Html->link(__('Login'), ['action' => 'login']) ?></li>
        <li><?= $this->Html->link(__('Reminder'), ['action' => 'reminder']) ?></li>
        <?php } ?>
        <li>&nbsp;</li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <?php if (isset($user)) { ?>
        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <?php } ?>
        <li><?= $this->Html->link(__('List Activations'), ['controller' => 'Activations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activation'), ['controller' => 'Activations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Persistences'), ['controller' => 'Persistences', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persistence'), ['controller' => 'Persistences', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reminders'), ['controller' => 'Reminders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reminder'), ['controller' => 'Reminders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Role Users'), ['controller' => 'RoleUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role User'), ['controller' => 'RoleUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Throttle'), ['controller' => 'Throttle', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Throttle'), ['controller' => 'Throttle', 'action' => 'add']) ?></li>
</ul>
</nav>