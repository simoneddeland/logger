<?php

namespace Anax\Logger;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CLogTesterCalculator implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Constructor
     *
     */
    public function __construct()
    {

    }

    public function calculateBigSum()
    {
        $this->logger->timestamp("Calculator", "calculateBigSum", "Innan beräkning");
        $sum = 0;
        for ($i = 0; $i < 500000; $i++) {
            $sum += $i;
        }

        $this->logger->timestamp("Calculator", "calculateBigSum", "Efter beräkning");
    }
}
