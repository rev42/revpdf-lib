<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;

class AbstractPartTest extends \PHPUnit_Framework_TestCase
{
    protected $part;
    
    public function setUp()
    {
        $this->part = $this->getMockForAbstractClass('AbstractPart');
        $this->part->expects($this->once())
                   ->method('getIdentifier')
                   ->will($this->returnValue('1'));
        $this->part->expects($this->once())
                   ->method('getIsDisplayed')
                   ->will($this->returnValue(false));
        $this->part->expects($this->once())
                   ->method('getStartPosition')
                   ->will($this->returnValue(0));
        $this->part->expects($this->once())
                   ->method('getHeight')
                   ->will($this->returnValue(0));
        $this->part->expects($this->once())
                   ->method('getElements')
                   ->will($this->returnValue(0));
        $this->part->expects($this->once())
                   ->method('getCurrentPosition')
                   ->will($this->returnValue(0));
        $this->part->expects($this->once())
                   ->method('getIsVisible')
                   ->will($this->returnValue(false));
        $this->part->expects($this->once())
                   ->method('getBackgroundColor')
                   ->will($this->returnValue('#FFF'));
    }
    
    public function tearDown()
    {
        $this->part = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(1, $this->part->getIdentifier());
    }
    
    public function testGetIsDisplayed()
    {
        $this->assertEquals(false, $this->part->getIsDisplayed());
    }
    
    public function testSetIsDisplayed()
    {
        $this->part->setIsDisplayed(true);
        $this->assertEquals(true, $this->part->getIsDisplayed());
        
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
                "width" => "20"
            ),
            array(
                "value" => "pageHeader textField2",
                "type" => "textField",
                "format" => "text",
                "posX" => "0",
                "posY" => "5",
                "height" => "5",
                "width" => "20",
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
    
    public function testGetIsVisible()
    {
        $this->assertEquals(false, $this->part->getIsVisible());
    }
    
    public function testSetIsVisible()
    {
        $this->part->setIsVisible(true);
        $this->assertEquals(true, $this->part->getIsVisible());
        
    }
    
    public function testGetBackgroundColor()
    {
        $this->assertEquals('#FFF', $this->part->getBackgroundColor());
    }
    
    public function testSetBackgroundColor()
    {
        $this->part->setBackgroundColor('F00');
        $this->assertEquals('F00', $this->part->getBackgroundColor());
        
    }
}