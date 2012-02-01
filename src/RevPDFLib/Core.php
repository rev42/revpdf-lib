<?php 
namespace RevPDFLib;

class Core
{
    const VERSION = '2.0.0 (20120129)';
    
    private $datasourceType = null;
    
    public function __construct($sourceType, $data)
    {
        $this->datasourceType = (string) $sourceType;
        $this->data = $data;
    }
    
    public function export()
    {
        if (isset($this->data)) {
            $data = $this->reader->parseData($data);
            $document = $this->exporter->createDocument($data);
            
            return $document;
        }
    }
    
    public function setDatasourceType($value)
    {
        $this->datasourceType = (string) $value;
    }
    
    public function getDatasourceType()
    {
        return $this->datasourceType;
    }
}