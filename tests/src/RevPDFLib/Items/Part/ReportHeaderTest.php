<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;
use RevPDFLib\Items\Part\ReportHeader;

class ReportHeaderTest extends \PHPUnit_Framework_TestCase
{
    protected $part;
    
    public function setUp()
    {
        $this->part = new \RevPDFLib\Items\Part\ReportHeader(array());
    }
    
    public function tearDown()
    {
        $this->part = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(1, $this->part->getIdentifier());
    }
    
    public function testIsDisplayed()
    {
        $this->assertEquals(false, $this->part->isDisplayed());
    }
    
    public function testSetIsDisplayed()
    {
        $this->part->setIsDisplayed(true);
        $this->assertEquals(true, $this->part->isDisplayed());
        
    }
    
    public function testGetStartPosition()
    {
        $this->assertEquals(0, $this->part->getStartPosition());
    }
    
    public function testGetStartPositionReportHeaderOnly()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(10);
        $report->addPart('reportheader', $this->part);
        $this->assertEquals(10, $report->getPart('reportheader')->getStartPosition());
    }
    
    public function testGetStartPositionPageHeaderThenReportHeader()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(20);
        
        $pageheader = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                           ->disableOriginalConstructor()
                           ->getMock();
        $pageheader->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(10));
        $pageheader->expects($this->any())
                   ->method('getIdentifier')
                   ->will($this->returnValue(0));
        $pageheader->expects($this->any())
                   ->method('getHeight')
                   ->will($this->returnValue(40));
        $pageheader->expects($this->any())
                   ->method('isVisible')
                   ->will($this->returnValue(true));
        
        $report->addPart('pageheader', $pageheader);
        $report->addPart('reportheader', $this->part);
        $this->assertEquals(60, $report->getPart('reportheader')->getStartPosition());
    }
    
    public function testGetStartPositionReportHeaderThenPageHeader()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(20);
        
        $pageheader = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                           ->disableOriginalConstructor()
                           ->getMock();
        $pageheader->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(10));
        $pageheader->expects($this->any())
                   ->method('getIdentifier')
                   ->will($this->returnValue(0));
        $pageheader->expects($this->any())
                   ->method('getHeight')
                   ->will($this->returnValue(40));
        $pageheader->expects($this->any())
                   ->method('isVisible')
                   ->will($this->returnValue(true));
        
        $report->addPart('reportheader', $this->part);
        $report->addPart('pageheader', $pageheader);
        $this->assertEquals(60, $report->getPart('reportheader')->getStartPosition());
    }
    
    public function testGetStartPositionInvisiblePageHeaderAndReportHeader()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(20);
        
        $pageheader = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                           ->disableOriginalConstructor()
                           ->getMock();
        $pageheader->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(10));
        $pageheader->expects($this->any())
                   ->method('getHeight')
                   ->will($this->returnValue(40));
        $pageheader->expects($this->any())
                   ->method('isVisible')
                   ->will($this->returnValue(false));
        
        $report->addPart('pageheader', $pageheader);
        $report->addPart('reportheader', $this->part);
        $this->assertEquals(20, $report->getPart('reportheader')->getStartPosition());
    }
    
    public function testGetStartPositionPageHeaderAndReportHeaderAndDetails()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(15);
        
        $pageheader = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                           ->disableOriginalConstructor()
                           ->getMock();
        $pageheader->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(10));
        $pageheader->expects($this->any())
                   ->method('getIdentifier')
                   ->will($this->returnValue(0));
        $pageheader->expects($this->any())
                   ->method('getHeight')
                   ->will($this->returnValue(40));
        $pageheader->expects($this->any())
                   ->method('isVisible')
                   ->will($this->returnValue(true));
        
        $details = $this->getMockBuilder('RevPDFLib\Items\Part\Details')
                        ->disableOriginalConstructor()
                        ->getMock();
        $details->expects($this->any())
                ->method('getStartPosition')
                ->will($this->returnValue(10));
        $details->expects($this->any())
                ->method('getIdentifier')
                ->will($this->returnValue(3));
        $details->expects($this->any())
                ->method('getHeight')
                ->will($this->returnValue(30));
        $details->expects($this->any())
                ->method('isVisible')
                ->will($this->returnValue(true));
        
        $report->addPart('pageheader', $pageheader);
        $report->addPart('reportheader', $this->part);
        $report->addPart('details', $details);
        $this->assertEquals(55, $report->getPart('reportheader')->getStartPosition());
    }
    
    public function testSetStartPosition()
    {
        $this->part->setStartPosition(10);
        $this->assertEquals(10, $this->part->getStartPosition());
    }
    
    public function testGetHeight()
    {
        $this->assertEquals(0, $this->part->getHeight());
    }
    
    public function testSetHeight()
    {
        $this->part->setHeight(15);
        $this->assertEquals(15, $this->part->getHeight());
        
    }
    
    public function testGetElements()
    {
        $this->assertCount(0, $this->part->getElements());
    }
    
    public function testSetElements()
    {
        $elements = array(
            array(
                "value" => "ReportHeader textfield1",
                "type" => "textfield",
                "format" => "text",
                "posX" => "0",
                "posY" => "0",
                "height" => "5",
                "width" => "20",
                "border" => 1,
            ),
            array(
                "value" => "ReportHeader textfield2",
                "type" => "textfield",
                "format" => "text",
                "posX" => "0",
                "posY" => "5",
                "height" => "5",
                "width" => "20",
                "border" => 1,
            )
        );
        
        $this->part->setElements($elements);
        
        $this->assertCount(2, $this->part->getElements());
    }
    
    public function testGetCurrentPosition()
    {
        $this->assertEquals(0, $this->part->getCurrentPosition());
    }
    
    public function testSetCurrentPosition()
    {
        $this->part->setCurrentPosition(20);
        $this->assertEquals(20, $this->part->getCurrentPosition());
        
    }
    
    public function testIsVisible()
    {
        $this->assertEquals(false, $this->part->isVisible());
    }
    
    public function testSetIsVisible()
    {
        $this->part->setIsVisible(true);
        $this->assertEquals(true, $this->part->isVisible());
        
    }
    
    public function testGetBackgroundColor()
    {
        $this->assertEquals('#FFF', $this->part->getBackgroundColor());
    }
    
    public function testSetBackgroundColor()
    {
        $this->part->setBackgroundColor('#F00');
        $this->assertEquals('#F00', $this->part->getBackgroundColor());
        
    }
}