<?php
use Migrations\AbstractMigration;

class CreateZipcodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('zipcodes');
        $table->addColumn('jis_code', 'integer', [
            'default' => 0,
            'limit' => 5,
            'null' => false,
        ]);
        $table->addColumn('zipcode_old', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('zipcode', 'integer', [
            'default' => 0,
            'limit' => 7,
            'null' => false,
        ]);
        $table->addColumn('prefecture_mb', 'string', [
            'default' => '',
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('city_mb', 'string', [
            'default' => '',
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('town_mb', 'string', [
            'default' => '',
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('prefecture', 'string', [
            'default' => '',
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('city', 'string', [
            'default' => '',
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('town', 'string', [
            'default' => '',
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('has_multi_zipcode', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('is_each_AZA', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('has_CHOU', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('is_multi_zipcode', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('update_reason', 'integer', [
            'default' => 0,
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('change_reason', 'integer', [
            'default' => 0,
            'limit' => 1,
            'null' => false,
        ]);
        $table->create();
    }
}
