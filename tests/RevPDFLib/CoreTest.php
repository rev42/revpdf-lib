<?php
class CoreTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->revpdflib = new RevPDFLib\Core();
    }
    
    public function setDatasourceTest()
    {
        $data = array();
        $this->revpdflib->setDatasource($data);
        
        $this->assertTrue(is_array($this->revpdflib->getDatasource()));
    }
}