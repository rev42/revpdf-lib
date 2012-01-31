<?php
namespace RevPDFLib\Reader;

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
