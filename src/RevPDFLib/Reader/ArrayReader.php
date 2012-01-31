<?php
namespace RevPDFLib\Reader;

class ArrayReader implements RevPDFLib\Reader\ReaderInterface
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
