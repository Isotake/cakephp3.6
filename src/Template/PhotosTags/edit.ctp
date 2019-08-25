<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PhotosTag $photosTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $photosTag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $photosTag->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Photos Tags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="photosTags form large-9 medium-8 columns content">
    <?= $this->Form->create($photosTag) ?>
    <fieldset>
        <legend><?= __('Edit Photos Tag') ?></legend>
        <?php
            echo $this->Form->control('photos_id', ['options' => $photos]);
            echo $this->Form->control('tags_id', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
