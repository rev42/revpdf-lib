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
                'bottomMargin' => '15'
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
}