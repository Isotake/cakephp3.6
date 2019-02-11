<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
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
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('permissions');
            echo $this->Form->control('last_login');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
