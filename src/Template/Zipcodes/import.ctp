<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zipcode[]|\Cake\Collection\CollectionInterface $zipcodes
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
<div class="zipcodes import large-9 medium-8 columns content">
    <h3><?= __('Import CSV') ?></h3>
    <?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>
    <div class="file-field input-field">
        <div class="btn">
            <span>File</span>

            <?=
            $this->Form->control('zipcodes_csv', [
                'type' => 'file',
                'placeholder' => 'zipcodes csv',
                'label' => false,
                'required' => 'required',
            ]);
            ?>
            <span class="required"></span>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>

    <?=
    $this->Form->button(__('Submit'), [
        "type" => 'submit',
        "class" => "btn-large waves-effect waves-light",
        "style" => "text-transform: none",
    ])
    ?>
    <?= $this->Form->end() ?>
</div>
