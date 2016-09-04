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
}
