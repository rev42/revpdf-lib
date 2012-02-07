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
        $details = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $pageHeader = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $reportHeader = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $this->report = new Report($data);
        $this->report->addPart('details', $details);
        $this->report->addPart('pageHeader', $pageHeader);
        $this->report->addPart('reportHeader', $reportHeader);
        $this->report->initializeParts();
    }
    
    public function testInitializeParts()
    {
        $this->report->initializeParts();
        
        foreach ($this->report->parts as $type => $part) {
            if ($type == 'pageHeader') {
                $this->assertEquals(10, $part->getStartPosition());
            }
        }
    }
}