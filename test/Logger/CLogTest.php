<?php

namespace ultimadark\Logger;

/**
 * A testclass
 * 
 */
class CLogTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test
     *
     * @return void
     *
     */
    public function testNumberOfTimestamps()
    {
        $log = new \ultimadark\Logger\CLog();
        
        $log->timestamp("test", "test");
        $log->timestamp("test2", "test2");

        $res = $log->numberOfTimestamps();
        $exp = 2;
        $this->assertEquals($res, $exp, "The number of timestamps does not match");
    }

    /**
     * Test
     *
     * @return void
     *
     */
    public function testTableHTML()
    {
        $log = new \ultimadark\Logger\CLog();
        
        $log->timestamp("test", "test");
        $log->timestamp("test2", "test2");

        $res = $log->timestampAsTable();

        $exp = 'logtable';
        $this->assertContains($exp, $res, "The table is not using the correct css class");

    }    

    /**
     * Test
     *
     * @return void
     *
     */
    public function testMostTimeConsumingDomain()
    {
        $log = new \ultimadark\Logger\CLog();
        
        $log->timestamp("testdomain", "test");
        $log->timestamp("testdomain", "test");

        $res = $log->mostTimeConsumingDomain();

        $exp = 'testdomain';
        $this->assertEquals($res, $exp, "The most time consuming domain is not correct.");

    }

    /**
     * Test
     *
     * @return void
     *
     */
    public function testMethodReturnTypes()
    {
        $log = new \ultimadark\Logger\CLog();
        
        $log->timestamp("testdomain", "test");
        $log->timestamp("testdomain", "test");

        $memres = $log->memoryPeak();
        $loadres = $log->pageLoadTime();

        $this->assertInternalType('float', $memres);
        $this->assertInternalType('float', $loadres);

    }

}
