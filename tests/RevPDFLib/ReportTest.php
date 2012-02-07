<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    protected $report;
    
    public function setUp()
    {
        $reportData = array(
            'report' => array(
                'author' => 'authorValue',
                'displayModeZoom' => 'displayModeZoomValue',
                'displayModeLayout' => 'displayModeLayoutValue',
                'keywords' => 'keywordsValue',
                'subject' => 'subjectValue',
                'title' => 'titleValue',
                'leftMargin' => '20',
                'topMargin' => '10',
                'rightMargin' => '5',
                'bottomMargin' => '15',
                'pageOrientation' => 'P'
            ),
        );
        
        $this->report = new Report($reportData);
    }
    
    public function testGetAuthor()
    {
        $this->assertEquals('authorValue', $this->report->getAuthor());
    }
    
    public function testGetDisplayModeZoom()
    {
        $this->assertEquals('displayModeZoomValue', $this->report->getDisplayModeZoom());
    }
    
    public function testGetDisplayModeLayout()
    {
        $this->assertEquals('displayModeLayout', $this->report->getDisplayModeLayout());
    }
    
    public function testGetKeywords()
    {
        $this->assertEquals('keywordsValue', $this->report->getKeywords());
    }
    
    public function testGetSubject()
    {
        $this->assertEquals('subjectValue', $this->report->getSubject());
    }
    
    public function testGetTitle()
    {
        $this->assertEquals('titleValue', $this->report->getTitle());
    }
    
    public function testGetLeftMargin()
    {
        $this->assertEquals(20, $this->report->getLeftMargin());
    }
    
    public function testGetTopMargin()
    {
        $this->assertEquals(10, $this->report->getTopMargin());
    }
    
    public function testGetRightMargin()
    {
        $this->assertEquals(5, $this->report->getRightMargin());
    }
    
    public function testGetBottomMargin()
    {
        $this->assertEquals(15, $this->report->getBottomMargin());
    }
    
    public function testGetPageOrientation()
    {
        $this->assertEquals('P', $this->report->getPageOrientation());
    }
}