<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zipcode $zipcode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Zipcode'), ['action' => 'edit', $zipcode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Zipcode'), ['action' => 'delete', $zipcode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zipcode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Zipcodes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Zipcode'), ['action' => 'add']) ?> </li>
        <li>&nbsp;</li>
        <li><?= $this->Html->link(__('CSV Import'), ['action' => 'import']) ?></li>
    </ul>
</nav>
<div class="zipcodes view large-9 medium-8 columns content">
    <h3><?= h($zipcode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Prefecture Mb') ?></th>
            <td><?= h($zipcode->prefecture_mb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City Mb') ?></th>
            <td><?= h($zipcode->city_mb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Town Mb') ?></th>
            <td><?= h($zipcode->town_mb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prefecture') ?></th>
            <td><?= h($zipcode->prefecture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($zipcode->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Town') ?></th>
            <td><?= h($zipcode->town) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($zipcode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jis Code') ?></th>
            <td><?= $this->Number->format($zipcode->jis_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode Old') ?></th>
            <td><?= $this->Number->format($zipcode->zipcode_old) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode') ?></th>
            <td><?= $this->Number->format($zipcode->zipcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Reason') ?></th>
            <td><?= $this->Number->format($zipcode->update_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Change Reason') ?></th>
            <td><?= $this->Number->format($zipcode->change_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Multi Zipcode') ?></th>
            <td><?= $zipcode->has_multi_zipcode ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Each AZA') ?></th>
            <td><?= $zipcode->is_each_AZA ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has CHOU') ?></th>
            <td><?= $zipcode->has_CHOU ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Multi Zipcode') ?></th>
            <td><?= $zipcode->is_multi_zipcode ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
