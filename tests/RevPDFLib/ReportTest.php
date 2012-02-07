<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
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
        
        $detailsData = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $pageHeaderData = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $reportHeaderData = array(
            'height' => 20,
            'isVisible' => 1,
            'elements' => array(
                'textField' => array(
                    'posX' => 5,
                    'posY' => 10,
                ),
            ),
        );
        
        $this->report = new Report($reportData);
        $this->report->addPart('details', new RevPDFLib\Part($detailsData));
        $this->report->addPart('pageHeader', new RevPDFLib\Part($pageHeaderData));
        $this->report->addPart('reportHeader', new RevPDFLib\Part($reportHeaderData));
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