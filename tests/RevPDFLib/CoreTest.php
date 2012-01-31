<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Core;

class CoreTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->revpdflib = new Core();
    }
    
    public function setDatasourceTest()
    {
        $this->revpdflib->setDatasourceType('array');
        
        $this->assertEquals('array', $this->revpdflib->getDatasourceType());
    }
}