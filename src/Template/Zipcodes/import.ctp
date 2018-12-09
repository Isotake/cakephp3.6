<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zipcode[]|\Cake\Collection\CollectionInterface $zipcodes
 */
?>

    <h6>Import CSV</h6>

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