<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $data = array(
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
        $part = $this->getMock('Part');
        
        $this->report = new Report($data);
        $this->report->parts['pageHeader'] = $part;
        $this->report->parts['reportHeader'] = $part;
        $this->report->parts['details'] = $part;
    }
    
    public function initializePartsTest()
    {
        $this->report->initializeParts();
        
        foreach ($this->report->parts as $type => $part) {
            if ($type == 'pageHeader') {
                $this->assertEquals(10, $part->getStartPosition());
            }
        }
    }
}