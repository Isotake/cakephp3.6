<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->element('Users/sidemenu', [null]) ?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Reminder') ?></h3>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Reminder') ?></legend>
        <?php
        echo $this->Form->control('email', ['value' => 'k.otsuka@daishokagaku.com']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
