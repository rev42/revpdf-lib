<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Event\AddPartEvent;
 
class AddPartEventTest extends \PHPUnit_Framework_TestCase
{
    protected $event;
    
    public function setUp()
    {
        $part = $this->getMockBuilder('RevPDFLib\Items\Part\PageHeader')
                     ->disableOriginalConstructor()
                     ->getMock();
        $this->event = new AddPartEvent($part, 10);
    }
    
    public function testGetPart()
    {
        $this->assertInstanceOf('RevPDFLib\Items\Part\PageHeader', $this->event->getPart());
    }
    
    public function testGetOffset()
    {
        $this->assertEquals(10, $this->event->getOffset());
    }
}