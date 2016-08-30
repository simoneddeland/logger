<?php
namespace Anax\Logger;

/**
 * Logger controller
 *
 */
class LogtesterController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    /**
    * Initialize the controller.
    *
    * @return void
    */
    public function initialize()
    {
        $this->logger->TimeStamp("LogTesterController", "initialize");
        $this->calculator = new \Anax\Logger\CLogTesterCalculator();
        $this->calculator->setDI($this->di);
    }

    public function indexAction()
    {
        $this->logger->TimeStamp("LogTesterController", "indexAction", "Innan title");
        $this->theme->setTitle("Testing logger class");
        $this->calculator->calculateBigSum();
        $this->logger->TimeStamp("LogTesterController", "indexAction", "Efter title");
        $this->views->addString($this->logger->TimeStampAsTable());
    }


}
