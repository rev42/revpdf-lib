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
        $this->assertInstanceOf('RevPDFLib\Items\Part\PageHeader', $this->getPart());
    }
    
    public function testGetOffset()
    {
        $this->assertEquals(10, $this->getOffset());
    }
    /*
    private $part;
    private $offset;
 
    public function __construct(\RevPDFLib\Items\Part\AbstractPart $part, $offset)
    {
        $this->part = $part;
        $this->offset = $offset;
    }
 
    public function getPart()
    {
        return $this->part;
    }
    
    public function getOffset()
    {
        return $this->offset;
    }*/
    
    
}