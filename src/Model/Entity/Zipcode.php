<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Zipcode Entity
 *
 * @property int $id
 * @property int $jis_code
 * @property int $zipcode_old
 * @property int $zipcode
 * @property string $prefecture_mb
 * @property string $city_mb
 * @property string $town_mb
 * @property string $prefecture
 * @property string $city
 * @property string $town
 * @property bool $has_multi_zipcode
 * @property bool $is_each_AZA
 * @property bool $has_CHOU
 * @property bool $is_multi_zipcode
 * @property int $update_reason
 * @property int $change_reason
 */
class Zipcode extends Entity
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
        'jis_code' => true,
        'zipcode_old' => true,
        'zipcode' => true,
        'prefecture_mb' => true,
        'city_mb' => true,
        'town_mb' => true,
        'prefecture' => true,
        'city' => true,
        'town' => true,
        'has_multi_zipcode' => true,
        'is_each_AZA' => true,
        'has_CHOU' => true,
        'is_multi_zipcode' => true,
        'update_reason' => true,
        'change_reason' => true
    ];
}
