<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ZipcodeHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ZipcodeHelper Test Case
 */
class ZipcodeHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ZipcodeHelper
     */
    public $Zipcode;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Zipcode = new ZipcodeHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Zipcode);

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
