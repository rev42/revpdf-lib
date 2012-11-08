<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;

class AbstractPartTest extends \PHPUnit_Framework_TestCase
{
    protected $part;
    
    public function setUp()
    {
        $this->part = $this->getMockForAbstractClass('\RevPDFLib\Items\Part\AbstractPart', array(), '', false);
        $this->part->expects($this->any())
                   ->method('getIdentifier')
                   ->will($this->returnValue('1'));
        $this->part->expects($this->any())
                   ->method('isDisplayed')
                   ->will($this->returnValue(false));
        $this->part->expects($this->any())
                   ->method('getStartPosition')
                   ->will($this->returnValue(0));
        $this->part->expects($this->any())
                   ->method('getHeight')
                   ->will($this->returnValue(0));
        $this->part->expects($this->any())
                   ->method('getElements')
                   ->will($this->returnValue(0));
        $this->part->expects($this->any())
                   ->method('getCurrentPosition')
                   ->will($this->returnValue(0));
        $this->part->expects($this->any())
                   ->method('isVisible')
                   ->will($this->returnValue(false));
        $this->part->expects($this->any())
                   ->method('getBackgroundColor')
                   ->will($this->returnValue('#FFF'));
        $this->part->expects($this->any())
                   ->method('getBorder')
                   ->will($this->returnValue('1'));
    }
    
    public function tearDown()
    {
        $this->part = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(null, $this->part->getIdentifier());
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
                "value" => "pageheader textfield1",
                "type" => "textfield",
                "format" => "text",
                "x" => "0",
                "y" => "0",
                "height" => "5",
                "width" => "20",
                "border" => "1"
            ),
            array(
                "value" => "pageheader textfield2",
                "type" => "textfield",
                "format" => "text",
                "x" => "0",
                "y" => "5",
                "height" => "5",
                "width" => "20",
                "border" => "1"
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
        $this->part->setBackgroundColor('#FFF');
        $this->assertEquals('#FFF', $this->part->getBackgroundColor());
    }
    
    public function testSetBackgroundColor()
    {
        $this->part->setBackgroundColor('F00');
        $this->assertEquals('#F00', $this->part->getBackgroundColor());
    }
    
    public function testSetIsPageJump()
    {
        $this->part->setIsPageJump(true);
        $this->assertTrue($this->part->isPageJump());
        
        $this->part->setIsPageJump(false);
        $this->assertFalse($this->part->isPageJump());
    }
}