<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;
use RevPDFLib\Items\Part\PageHeader;

class DetailsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Details
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \RevPDFLib\Items\Part\Details(array());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(3, $this->object->getIdentifier());
    }
    
    public function testGetStartPositionDetailsOnly()
    {
        $report = new \RevPDFLib\Report();
        $report->setTopMargin(10);
        $report->addPart('details', $this->object);
        $this->assertEquals(10, $report->getPart('details')->getStartPosition());
    }
    
    public function testGetStartPositionPageHeaderThenDetails()
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
        $report->addPart('details', $this->object);
        $this->assertEquals(60, $report->getPart('details')->getStartPosition());
    }
    
    public function testGetStartPositionInvisiblePageHeaderThenDetails()
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
                   ->will($this->returnValue(false));
        
        $report->addPart('details', $this->object);
        $report->addPart('pageheader', $pageheader);
        $this->assertEquals(20, $report->getPart('details')->getStartPosition());
    }

}

?>
