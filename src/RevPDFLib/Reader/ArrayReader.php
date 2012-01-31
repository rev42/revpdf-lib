<?php
namespace RevPDFLib\Reader;
require_once 'ReaderInterface.php';
use RevPDFLib\Reader\ReaderInterface;

class ArrayReader implements ReaderInterface
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function parseData()
    {
        
    }
}
