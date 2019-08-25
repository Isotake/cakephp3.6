<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PhotosTag $photosTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Photos Tag'), ['action' => 'edit', $photosTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Photos Tag'), ['action' => 'delete', $photosTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $photosTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Photos Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photos Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="photosTags view large-9 medium-8 columns content">
    <h3><?= h($photosTag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= $photosTag->has('photo') ? $this->Html->link($photosTag->photo->id, ['controller' => 'Photos', 'action' => 'view', $photosTag->photo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= $photosTag->has('tag') ? $this->Html->link($photosTag->tag->id, ['controller' => 'Tags', 'action' => 'view', $photosTag->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($photosTag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($photosTag->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($photosTag->modified) ?></td>
        </tr>
    </table>
</div>
