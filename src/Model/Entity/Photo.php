<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Photo Entity
 *
 * @property int $id
 * @property int $player_id
 * @property string $filename_full
 * @property string $filename
 * @property string $extension
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Player $player
 * @property \App\Model\Entity\Tag[] $tags
 */
class Photo extends Entity
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
        'player_id' => true,
        'filename_full' => true,
        'filename' => true,
        'extension' => true,
        'created' => true,
        'modified' => true,
        'player' => true,
        'tags' => true
    ];
}
