<?php
 
namespace RevPDFLib\Event;
 
use Symfony\Component\EventDispatcher\Event;
 
class AddPartEvent extends Event
{
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
    }
}