<?php
use Migrations\AbstractSeed;

/**
 * Employees seed.
 */
class EmployeesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'parent_id' => NULL,
                'name' => 'Adachi',
                'lft' => '1',
                'rght' => '14',
            ],
            [
                'id' => '2',
                'parent_id' => '1',
                'name' => 'Ikari',
                'lft' => '2',
                'rght' => '3',
            ],
            [
                'id' => '3',
                'parent_id' => '1',
                'name' => 'Ueda',
                'lft' => '4',
                'rght' => '13',
            ],
            [
                'id' => '4',
                'parent_id' => '3',
                'name' => 'Ezaki',
                'lft' => '5',
                'rght' => '8',
            ],
            [
                'id' => '5',
                'parent_id' => '4',
                'name' => 'Kishima',
                'lft' => '6',
                'rght' => '7',
            ],
            [
                'id' => '6',
                'parent_id' => '3',
                'name' => 'Ohgami',
                'lft' => '9',
                'rght' => '10',
            ],
            [
                'id' => '7',
                'parent_id' => '3',
                'name' => 'Katou',
                'lft' => '11',
                'rght' => '12',
            ],
        ];

        $table = $this->table('employees');
        $table->insert($data)->save();
    }
}
