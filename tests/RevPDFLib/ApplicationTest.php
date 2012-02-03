<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->revpdflib = new Application();
    }
    
    public function setDatasourceTest()
    {
        $this->revpdflib->setDatasourceType('array');
        
        $this->assertEquals('array', $this->revpdflib->getDatasourceType());
    }
}