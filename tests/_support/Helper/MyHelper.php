<?php
namespace Helper;

use Codeception\Test\Descriptor;
use Codeception\TestInterface;

class MyHelper extends \Codeception\Module
{
    public $test;

    public $webDriver;

    public function _before(TestInterface $test)
    {
        $this->test = $test;
        $this->webDriver = $this->getModule('WebDriver');
    }

    public function checkImageChange($identifier, $elementID, $count = 1, $wait = null)
    {
        $fileName = str_replace('.png', '', $this->getImageName($this->test, $identifier));

        for (; $count > 0; $count--) {
            $this->webDriver->makeElementScreenshot($elementID, $fileName);

            if ($wait) {
                sleep($wait);
            }

            $this->getModule('VisualCeption')->seeVisualChanges($identifier, $elementID);
        }
    }

    public function getImageName(TestInterface $test, $identifier)
    {
        $filename = preg_replace('~\W~', '.', Descriptor::getTestSignatureUnique($test));
        return mb_strcut($filename, 0, 249 - strlen($identifier), 'utf-8') . '.' . $identifier;
    }
}
