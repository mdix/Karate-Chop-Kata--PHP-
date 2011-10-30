<?php
require_once dirname(__FILE__) . '/../Chopper.php';

class ChopperTest extends PHPUnit_Framework_TestCase {
    private $chopObj;
    private $testArray = array(1,2,7,15,17,23,30,33,34,35,36,40,44,49,50,55,60,66,67,68,90,100,111,112,113,114);
    
    protected function setUp() {
        $this->chopObj = new Chopper;
    }

    public function testChopIterative() {
        $this->assertEquals(0, $this->chopObj->chopIterative(1, $this->testArray));
        $this->assertEquals(1, $this->chopObj->chopIterative(2, $this->testArray));
        $this->assertEquals(2, $this->chopObj->chopIterative(7, $this->testArray));
        $this->assertEquals(3, $this->chopObj->chopIterative(15, $this->testArray));
        $this->assertEquals(17, $this->chopObj->chopIterative(66, $this->testArray));
        $this->assertEquals(25, $this->chopObj->chopIterative(114, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopIterative(10, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopIterative(22, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopIterative(-2, $this->testArray));
    }

    public function testChopRecursive() {
        $this->assertEquals(0, $this->chopObj->chopRecursive(1, $this->testArray));
        $this->assertEquals(1, $this->chopObj->chopRecursive(2, $this->testArray));
        $this->assertEquals(2, $this->chopObj->chopRecursive(7, $this->testArray));
        $this->assertEquals(3, $this->chopObj->chopRecursive(15, $this->testArray));
        $this->assertEquals(17, $this->chopObj->chopRecursive(66, $this->testArray));
        $this->assertEquals(25, $this->chopObj->chopRecursive(114, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRecursive(10, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRecursive(22, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRecursive(-2, $this->testArray));
    }

    public function testChopSlice() {
        $this->assertEquals(0, $this->chopObj->chopSlice(1, $this->testArray));
        $this->assertEquals(1, $this->chopObj->chopSlice(2, $this->testArray));
        $this->assertEquals(2, $this->chopObj->chopSlice(7, $this->testArray));
        $this->assertEquals(3, $this->chopObj->chopSlice(15, $this->testArray));
        $this->assertEquals(17, $this->chopObj->chopSlice(66, $this->testArray));
        $this->assertEquals(25, $this->chopObj->chopSlice(114, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopSlice(10, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopSlice(22, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopSlice(-2, $this->testArray));
    }

    public function testChopFirstLastPop() {
        $this->assertEquals(0, $this->chopObj->chopFirstLastPop(1, $this->testArray));
        $this->assertEquals(1, $this->chopObj->chopFirstLastPop(2, $this->testArray));
        $this->assertEquals(2, $this->chopObj->chopFirstLastPop(7, $this->testArray));
        $this->assertEquals(3, $this->chopObj->chopFirstLastPop(15, $this->testArray));
        $this->assertEquals(17, $this->chopObj->chopFirstLastPop(66, $this->testArray));
        $this->assertEquals(25, $this->chopObj->chopFirstLastPop(114, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopFirstLastPop(10, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopFirstLastPop(22, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopFirstLastPop(-2, $this->testArray));
    }

    public function testChopRandom() {
        $this->assertEquals(0, $this->chopObj->chopRandom(1, $this->testArray));
        $this->assertEquals(1, $this->chopObj->chopRandom(2, $this->testArray));
        $this->assertEquals(2, $this->chopObj->chopRandom(7, $this->testArray));
        $this->assertEquals(3, $this->chopObj->chopRandom(15, $this->testArray));
        $this->assertEquals(17, $this->chopObj->chopRandom(66, $this->testArray));
        $this->assertEquals(25, $this->chopObj->chopRandom(114, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRandom(10, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRandom(22, $this->testArray));
        $this->assertEquals(-1, $this->chopObj->chopRandom(-2, $this->testArray));
    }
    
}
?>
