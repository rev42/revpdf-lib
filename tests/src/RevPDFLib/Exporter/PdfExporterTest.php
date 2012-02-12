<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Exporter\PdfExporter;

class PdfExporterTest extends \PHPUnit_Framework_TestCase
{
    protected $exporter;
     
    public function setUp()
    {
        $wrapper = $this->getMock('\RevPDFLib\Wrapper\WrapperInterface', array('setReport', 'configure'));
        $report = $this->getMock('RevPDFLib\Report', array('addPart', 'setAllProperties'));
        
        $wrapper->expects($this->any())
                ->method('setReport')
                ->with($this->equalTo($report));
        $wrapper->expects($this->any())
                ->method('configure')
                ->will($this->returnValue(''));
        
        $this->exporter = new PdfExporter($wrapper, $report);
    }
    
    public function tearDown()
    {
        $this->exporter = null;
    }
    
    public function testBuildDocumentWithPageHeaderOnly()
    {
       $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}