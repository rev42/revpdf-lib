<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Wrapper\TfpdfWrapper;

class TfpdfWrapperTest extends \PHPUnit_Framework_TestCase
{
    protected $wrapper;
    
    public function setUp()
    {
        $this->wrapper = new TfpdfWrapper();
    }
    
    public function tearDown()
    {
        $this->wrapper = null;
    }
    /*
    public function testWritePDF()
    {
        $pageHeader = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                           ->disableOriginalConstructor()
                           ->getMock();
        $pageHeader->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(10));
        
        $textfield = $this->getMockBuilder('RevPDFLib\Items\Element\Textfield')
                          ->disableOriginalConstructor()
                          ->getMock();
        $textzone = $this->getMockBuilder('RevPDFLib\Items\Element\Textzone')
                         ->disableOriginalConstructor()
                         ->getMock();
        
        $reportHeader = $this->getMockBuilder('RevPDFLib\Items\Part\ReportHeader')
                             ->disableOriginalConstructor()
                             ->getMock();
        $reportHeader->expects($this->any())
                     ->method('getStartPosition')
                     ->will($this->returnValue(20));
        $reportHeader->expects($this->any())
                     ->method('getElements')
                     ->will($this->returnValue(array($textfield, $textzone)));
        
        $this->wrapper->writePDF($pageHeader, array());
        $this->assertEquals(10, $this->wrapper->getCurrentPosition());
        
        $this->wrapper->writePDF($reportHeader, array());
        $this->assertEquals(20, $this->wrapper->getCurrentPosition());
    }*/
}