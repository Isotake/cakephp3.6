<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->element('Users/sidemenu', [null]) ?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Login') ?></h3>
    <?= $this->Form->create(null, ['type' => 'post']) ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?php
        echo $this->Form->control('email', ['value' => 'k.otsuka@daishokagaku.com']);
        echo $this->Form->control('password', ['value' => '1234']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
