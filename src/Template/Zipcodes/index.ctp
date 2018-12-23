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
    </ul>
</nav>
<div class="zipcodes index large-9 medium-8 columns content">
    <h3><?= __('Zipcodes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jis_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode_old') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prefecture_mb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_mb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('town_mb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prefecture') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('town') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_multi_zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_each_AZA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_CHOU') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_multi_zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('change_reason') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($zipcodes as $zipcode): ?>
            <tr>
                <td><?= $zipcode->id ?></td>
                <td><?= $zipcode->jis_code ?></td>
                <td><?= $zipcode->zipcode_old ?></td>
                <td><?= $zipcode->zipcode ?></td>
                <td><?= h($zipcode->prefecture_mb) ?></td>
                <td><?= h($zipcode->city_mb) ?></td>
                <td><?= h($zipcode->town_mb) ?></td>
                <td><?= h($zipcode->prefecture) ?></td>
                <td><?= h($zipcode->city) ?></td>
                <td><?= h($zipcode->town) ?></td>
                <td><?= $this->Zipcode->convert_hasMultiZipcode($zipcode->has_multi_zipcode) ?></td>
                <td><?= $this->Zipcode->convert_isEachAza($zipcode->is_each_AZA) ?></td>
                <td><?= $this->Zipcode->convert_hasChou($zipcode->has_CHOU) ?></td>
                <td><?= $this->Zipcode->convert_isMultiZipcode($zipcode->is_multi_zipcode) ?></td>
                <td><?= $zipcode->update_reason ?></td>
                <td><?= $zipcode->change_reason ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $zipcode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $zipcode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zipcode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zipcode->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
