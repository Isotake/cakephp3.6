<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->element('Users/sidemenu', [null]) ?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Signup') ?></h3>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Signup') ?></legend>
        <?php
        echo $this->Form->control('email', ['value' => 'k.otsuka@daishokagaku.com']);
        echo $this->Form->control('password', ['value' => '1234']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
