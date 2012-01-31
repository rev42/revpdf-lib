<?php
namespace RevPDFLib\Reader;

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
