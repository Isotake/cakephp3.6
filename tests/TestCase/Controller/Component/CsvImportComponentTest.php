<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CsvImportComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CsvImportComponent Test Case
 */
class CsvImportComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CsvImportComponent
     */
    public $CsvImport;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->CsvImport = new CsvImportComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CsvImport);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
