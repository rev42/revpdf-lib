<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;
use RevPDFLib\Items\Part\PageHeader;

class PageHeaderTest extends \PHPUnit_Framework_TestCase
{
    protected $part;
    
    public function setUp()
    {
        $this->part = new \RevPDFLib\Items\Part\PageHeader(array());
    }
    
    public function tearDown()
    {
        $this->part = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(0, $this->part->getIdentifier());
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
                "value" => "pageHeader textField1",
                "type" => "textField",
                "format" => "text",
                "posX" => "0",
                "posY" => "0",
                "height" => "5",
                "width" => "20",
                "border" => 1,
            ),
            array(
                "value" => "pageHeader textField2",
                "type" => "textField",
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