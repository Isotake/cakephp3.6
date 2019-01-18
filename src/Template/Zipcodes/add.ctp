<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zipcode $zipcode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Zipcodes'), ['action' => 'index']) ?></li>
        <li>&nbsp;</li>
        <li><?= $this->Html->link(__('CSV Import'), ['action' => 'import']) ?></li>
    </ul>
</nav>
<div class="zipcodes form large-9 medium-8 columns content">
    <?= $this->Form->create($zipcode) ?>
    <fieldset>
        <legend><?= __('Add Zipcode') ?></legend>
        <?php
            echo $this->Form->control('jis_code');
            echo $this->Form->control('zipcode_old');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('prefecture_mb');
            echo $this->Form->control('city_mb');
            echo $this->Form->control('town_mb');
            echo $this->Form->control('prefecture');
            echo $this->Form->control('city');
            echo $this->Form->control('town');
            echo $this->Form->control('has_multi_zipcode');
            echo $this->Form->control('is_each_AZA');
            echo $this->Form->control('has_CHOU');
            echo $this->Form->control('is_multi_zipcode');
            echo $this->Form->control('update_reason');
            echo $this->Form->control('change_reason');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
