<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $permissions
 * @property \Cake\I18n\FrozenTime|null $last_login
 * @property string|null $first_name
 * @property string|null $last_name
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Activation[] $activations
 * @property \App\Model\Entity\Persistence[] $persistences
 * @property \App\Model\Entity\Reminder[] $reminders
 * @property \App\Model\Entity\RoleUser[] $role_users
 * @property \App\Model\Entity\Throttle[] $throttle
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'permissions' => true,
        'last_login' => true,
        'first_name' => true,
        'last_name' => true,
        'created_at' => true,
        'updated_at' => true,
        'activations' => true,
        'persistences' => true,
        'reminders' => true,
        'role_users' => true,
        'throttle' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
