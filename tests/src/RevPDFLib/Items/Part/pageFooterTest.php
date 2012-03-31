<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Items\Part\AbstractPart;
use RevPDFLib\Items\Part\PageHeader;

class PageFooterTest extends \PHPUnit_Framework_TestCase
{
    protected $object;
    
    public function setUp()
    {
        $this->object = new \RevPDFLib\Items\Part\PageFooter(array());
    }
    
    public function tearDown()
    {
        $this->object = null;
    }
    
    public function testGetIdentifier()
    {
        $this->assertEquals(6, $this->object->getIdentifier());
    }
}