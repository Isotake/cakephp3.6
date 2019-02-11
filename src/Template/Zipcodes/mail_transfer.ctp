<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zipcode[]|\Cake\Collection\CollectionInterface $zipcodes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Zipcode'), ['action' => 'add']) ?></li>
        <li>&nbsp;</li>
        <li><?= $this->Html->link(__('CSV Import'), ['action' => 'import']) ?></li>
    </ul>
</nav>
<div class="zipcodes index large-9 medium-8 columns content">
    <h3><?= __('Mail Transfer') ?></h3>
</div>
