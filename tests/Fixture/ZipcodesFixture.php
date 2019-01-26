<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ZipcodesFixture
 *
 */
class ZipcodesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'jis_code' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'zipcode_old' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'zipcode' => ['type' => 'integer', 'length' => 7, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'prefecture_mb' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'city_mb' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'town_mb' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'prefecture' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'town' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'has_multi_zipcode' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_each_AZA' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'has_CHOU' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_multi_zipcode' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'update_reason' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'change_reason' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            array('id' => '1', 'jis_code' => '1101', 'zipcode_old' => '64', 'zipcode' => '640941', 'prefecture_mb' => 'ﾎｯｶｲﾄﾞｳ', 'city_mb' => 'ｻｯﾎﾟﾛｼﾁｭｳｵｳｸ', 'town_mb' => 'ｱｻﾋｶﾞｵｶ', 'prefecture' => '北海道', 'city' => '札幌市中央区', 'town' => '旭ケ丘', 'has_multi_zipcode' => '0', 'is_each_AZA' => '0', 'has_CHOU' => '1', 'is_multi_zipcode' => '0', 'update_reason' => '0', 'change_reason' => '0'),
            array('id' => '2', 'jis_code' => '1101', 'zipcode_old' => '60', 'zipcode' => '600041', 'prefecture_mb' => 'ﾎｯｶｲﾄﾞｳ', 'city_mb' => 'ｻｯﾎﾟﾛｼﾁｭｳｵｳｸ', 'town_mb' => 'ｵｵﾄﾞｵﾘﾋｶﾞｼ', 'prefecture' => '北海道', 'city' => '札幌市中央区', 'town' => '大通東', 'has_multi_zipcode' => '0', 'is_each_AZA' => '0', 'has_CHOU' => '1', 'is_multi_zipcode' => '0', 'update_reason' => '0', 'change_reason' => '0'),
            array('id' => '3', 'jis_code' => '1101', 'zipcode_old' => '60', 'zipcode' => '600042', 'prefecture_mb' => 'ﾎｯｶｲﾄﾞｳ', 'city_mb' => 'ｻｯﾎﾟﾛｼﾁｭｳｵｳｸ', 'town_mb' => 'ｵｵﾄﾞｵﾘﾆｼ(1-19ﾁｮｳﾒ)', 'prefecture' => '北海道', 'city' => '札幌市中央区', 'town' => '大通西（１〜１９丁目）', 'has_multi_zipcode' => '1', 'is_each_AZA' => '0', 'has_CHOU' => '1', 'is_multi_zipcode' => '0', 'update_reason' => '0', 'change_reason' => '0')
        ];
        parent::init();
    }
}
