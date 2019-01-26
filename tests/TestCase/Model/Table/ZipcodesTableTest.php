<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ZipcodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZipcodesTable Test Case
 */
class ZipcodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ZipcodesTable
     */
    public $ZipcodesTable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.zipcodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Zipcodes') ? [] : ['className' => ZipcodesTable::class];
        $this->ZipcodesTable = TableRegistry::getTableLocator()->get('Zipcodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ZipcodesTable);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
//        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testZipcodesTableFind() {
        $result = $this->ZipcodesTable->find('all')->first();
        $this->assertFalse(empty($result));
        $this->assertTrue(is_a($result, 'App\Model\Entity\Zipcode'));
        $this->assertEquals($result->id, 1);
//        $this->assertStringStartsWith('6', $result->zipcode);
    }
}
