<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PhotosTag[]|\Cake\Collection\CollectionInterface $photosTags
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Photos Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="photosTags index large-9 medium-8 columns content">
    <h3><?= __('Photos Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photos_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tags_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($photosTags as $photosTag): ?>
            <tr>
                <td><?= $this->Number->format($photosTag->id) ?></td>
                <td><?= $photosTag->has('photo') ? $this->Html->link($photosTag->photo->id, ['controller' => 'Photos', 'action' => 'view', $photosTag->photo->id]) : '' ?></td>
                <td><?= $photosTag->has('tag') ? $this->Html->link($photosTag->tag->id, ['controller' => 'Tags', 'action' => 'view', $photosTag->tag->id]) : '' ?></td>
                <td><?= h($photosTag->created) ?></td>
                <td><?= h($photosTag->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $photosTag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $photosTag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $photosTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $photosTag->id)]) ?>
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
