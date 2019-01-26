<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Zipcode;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Zipcode Test Case
 */
class ZipcodeTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Entity\Zipcode
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
        $this->Zipcode = new Zipcode();
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
//        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testBoardInstance() {
        $this->assertTrue(is_a($this->Zipcode, 'App\Model\Entity\Zipcode'));
    }
}
