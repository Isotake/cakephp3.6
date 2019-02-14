<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->element('Users/sidemenu', [null]) ?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Signup - Confirm') ?></h3>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Signup - Confirm') ?></legend>
        <?php
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Confirm')) ?>
    <?= $this->Form->end() ?>
</div>
