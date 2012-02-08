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
        $this->assertEquals('displayModeLayoutValue', $this->report->getDisplayModeLayout());
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
    
    public function testGetAllProperties()
    {
        $this->assertNotEmpty($this->report->getAllProperties());
    }
    
    public function testSetters()
    {
        $this->report->setAuthor('new author');
        $this->assertEquals('new author', $this->report->getAuthor());
        
        $this->report->setDisplayModeZoom('new DMZ');
        $this->assertEquals('new DMZ', $this->report->getDisplayModeZoom());
        
        $this->report->setDisplayModeLayout('new DML');
        $this->assertEquals('new DML', $this->report->getDisplayModeLayout());
        
        $this->report->setKeywords('new key');
        $this->assertEquals('new key', $this->report->getKeywords());
        
        $this->report->setSubject('new sub');
        $this->assertEquals('new sub', $this->report->getSubject());
        
        $this->report->setTitle('new tit');
        $this->assertEquals('new tit', $this->report->getTitle());
        
        $this->report->setLeftMargin(1);
        $this->assertEquals(1, $this->report->getLeftMargin());
        
        $this->report->setTopMargin(2);
        $this->assertEquals(2, $this->report->getTopMargin());
        
        $this->report->setRightMargin(3);
        $this->assertEquals(3, $this->report->getRightMargin());
        
        $this->report->setBottomMargin(4);
        $this->assertEquals(4, $this->report->getBottomMargin());
        
        $this->report->setLeftMargin('A');
        $this->assertEquals(0, $this->report->getLeftMargin());
        
        $this->report->setTopMargin('A');
        $this->assertEquals(0, $this->report->getTopMargin());
        
        $this->report->setRightMargin('A');
        $this->assertEquals(0, $this->report->getRightMargin());
        
        $this->report->setBottomMargin('A');
        $this->assertEquals(0, $this->report->getBottomMargin());
        
        $this->report->setPageOrientation('P');
        $this->assertEquals('P', $this->report->getPageOrientation());
        
        $this->report->setPageOrientation('L');
        $this->assertEquals('L', $this->report->getPageOrientation());
        
        $this->report->setPageOrientation('X');
        $this->assertEquals('P', $this->report->getPageOrientation());
    }
    
    public function testGetPart()
    {
        $part = $this->getMockBuilder('RevPDFLib\Part')
                     ->disableOriginalConstructor()
                     ->getMock();
        $this->report->addPart('details', $part);
        
        $this->assertInstanceOf('RevPDFLib\Part', $this->report->getPart('details'));
        $this->assertNull($this->report->getPart('pageHeaders'));
    }
    
    public function testAddPart()
    {
        $part = $this->getMockBuilder('RevPDFLib\PageHeader')
                     ->disableOriginalConstructor()
                     ->getMock();
        $this->report->addPart('PageHeader', $part);
        
        $this->assertCount(1, $this->report->getParts());
    }
    
    public function testInitializePartsWithNoPart()
    {
        $this->assertNull($this->report->initializeParts());
    }
}