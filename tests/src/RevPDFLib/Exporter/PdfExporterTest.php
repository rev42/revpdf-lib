<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Exporter\PdfExporter;

class PdfExporterTest extends \PHPUnit_Framework_TestCase
{
    protected $exporter;
     
    public function setUp()
    {
        $wrapper = $this->getMock('\RevPDFLib\Wrapper\WrapperInterface', array('setReport', 'configure'));
        //$report = $this->getMock('RevPDFLib\Report', array('addPart', 'setAllProperties'));
        
        /*$wrapper->expects($this->any())
                ->method('setReport')
                ->with($this->equalTo($report));
        */
        $reportData = array(
            'report' => array(
                'author' => '',
                'keywords' => '',
                'subject' => '',
                'title' => '',
                'leftMargin' => 10,
                'topMargin' => 10,
                'rightMargin' => 10,
                'bottomMargin' => 10,
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'paperFormat' => 'A4',
                'pageOrientation' => 'P'
            ),
            'details' => array(
                'height' => '10',
                'isVisible' => '1',
                'backgroundColor' => '',
                'isPageJump' => '0',
                'isIndivisible' => '0',
                'isAutoExtend' => '0',
                'isAutoReduc' => '0',
                'sortOrder' => 'asc'
            ),
            'pageFooter' => array(
                'height' => '10',
                'isVisible' => '1',
                'backgroundColor' => '',
                'isPageJump' => '0',
                'isIndivisible' => '0',
                'isAutoExtend' => '0',
                'isAutoReduc' => '0',
                'sortOrder' => 'asc'
            )
        );
        $report = new \RevPDFLib\Report();
        $report->setAllProperties($reportData);
        $wrapper->expects($this->any())
                ->method('configure')
                ->will($this->returnValue(''));
        
        $this->exporter = new PdfExporter($wrapper, $report);
    }
    
    public function tearDown()
    {
        $this->exporter = null;
    }
    
    public function testBuildDocumentWithDetailAndPageFooter()
    {
        $reportData = array(
            'report' => array(
                'author' => '',
                'keywords' => '',
                'subject' => '',
                'title' => '',
                'leftMargin' => 10,
                'topMargin' => 10,
                'rightMargin' => 10,
                'bottomMargin' => 10,
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'paperFormat' => 'A4',
                'pageOrientation' => 'P'
            ),
            'details' => array(
                'height' => '10',
                'isVisible' => '1',
                'backgroundColor' => '',
                'isPageJump' => '0',
                'isIndivisible' => '0',
                'isAutoExtend' => '0',
                'isAutoReduc' => '0',
                'sortOrder' => 'asc'
            ),
            'pageFooter' => array(
                'height' => '10',
                'isVisible' => '1',
                'backgroundColor' => '',
                'isPageJump' => '0',
                'isIndivisible' => '0',
                'isAutoExtend' => '0',
                'isAutoReduc' => '0',
                'sortOrder' => 'asc'
            )
        );
        $this->exporter->buildDocument($reportData);

        $report = $this->exporter->getReport();
        $this->assertEquals(10, $report->getPart('details')->getStartPosition());
        // Start position de Page Footer devrait être 277.. Impossible à calculer à ce moment
        //$this->assertEquals(277, $report->getPart('pageFooter')->getStartPosition());
    }
}