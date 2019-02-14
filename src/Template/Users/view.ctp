<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->element('Users/sidemenu', [$user]) ?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Login') ?></th>
            <td><?= h($user->last_login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($user->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($user->updated_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Permissions') ?></h4>
        <?= $this->Text->autoParagraph(h($user->permissions)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Activations') ?></h4>
        <?php if (!empty($user->activations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Completed') ?></th>
                <th scope="col"><?= __('Completed At') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->activations as $activations): ?>
            <tr>
                <td><?= h($activations->id) ?></td>
                <td><?= h($activations->user_id) ?></td>
                <td><?= h($activations->code) ?></td>
                <td><?= h($activations->completed) ?></td>
                <td><?= h($activations->completed_at) ?></td>
                <td><?= h($activations->created_at) ?></td>
                <td><?= h($activations->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activations', 'action' => 'view', $activations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activations', 'action' => 'edit', $activations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activations', 'action' => 'delete', $activations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Persistences') ?></h4>
        <?php if (!empty($user->persistences)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->persistences as $persistences): ?>
            <tr>
                <td><?= h($persistences->id) ?></td>
                <td><?= h($persistences->user_id) ?></td>
                <td><?= h($persistences->code) ?></td>
                <td><?= h($persistences->created_at) ?></td>
                <td><?= h($persistences->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Persistences', 'action' => 'view', $persistences->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Persistences', 'action' => 'edit', $persistences->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Persistences', 'action' => 'delete', $persistences->id], ['confirm' => __('Are you sure you want to delete # {0}?', $persistences->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Reminders') ?></h4>
        <?php if (!empty($user->reminders)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Completed') ?></th>
                <th scope="col"><?= __('Completed At') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->reminders as $reminders): ?>
            <tr>
                <td><?= h($reminders->id) ?></td>
                <td><?= h($reminders->user_id) ?></td>
                <td><?= h($reminders->code) ?></td>
                <td><?= h($reminders->completed) ?></td>
                <td><?= h($reminders->completed_at) ?></td>
                <td><?= h($reminders->created_at) ?></td>
                <td><?= h($reminders->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reminders', 'action' => 'view', $reminders->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reminders', 'action' => 'edit', $reminders->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reminders', 'action' => 'delete', $reminders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reminders->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Role Users') ?></h4>
        <?php if (!empty($user->role_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->role_users as $roleUsers): ?>
            <tr>
                <td><?= h($roleUsers->user_id) ?></td>
                <td><?= h($roleUsers->role_id) ?></td>
                <td><?= h($roleUsers->created_at) ?></td>
                <td><?= h($roleUsers->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RoleUsers', 'action' => 'view', $roleUsers->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RoleUsers', 'action' => 'edit', $roleUsers->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RoleUsers', 'action' => 'delete', $roleUsers->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roleUsers->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Throttle') ?></h4>
        <?php if (!empty($user->throttle)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Ip') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->throttle as $throttle): ?>
            <tr>
                <td><?= h($throttle->id) ?></td>
                <td><?= h($throttle->user_id) ?></td>
                <td><?= h($throttle->type) ?></td>
                <td><?= h($throttle->ip) ?></td>
                <td><?= h($throttle->created_at) ?></td>
                <td><?= h($throttle->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Throttle', 'action' => 'view', $throttle->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Throttle', 'action' => 'edit', $throttle->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Throttle', 'action' => 'delete', $throttle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $throttle->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
