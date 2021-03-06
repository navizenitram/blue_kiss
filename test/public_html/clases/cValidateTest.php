<?php
include_once 'public_html/clases/cValidate.php';
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-03-16 at 17:17:34.
 */
class cValidateTest extends PHPUnit_Framework_TestCase {

    /**
     * @var cValidate
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new cValidate;
       
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers cValidate::isValid
     * 
     */
    public function testIsValidTrue() {
        
         $this->object->setField('name', '');
         $this->assertEquals(false, $this->object->isValid());
         
    }
    /**
     * @covers cValidate::isValid
     * 
     */
    public function testIsValidFalse() {
        
         $this->object->setField('name', 'test');
         $this->assertEquals(true, $this->object->isValid());
    }

    /**
     * @covers cValidate::getErrors
     * 
     */
    public function testGetErrors() {
        $this->object->setField('name', '');
        $this->assertInternalType('array', $this->object->getErrors());
    }

}
