<?php 
namespace RevPDFLib;

class Application
{
    const VERSION = '2.0.0 (20120129)';
    
    private $datasourceType = null;
    
    public function __construct()
    {
    }
    
    public function export($data)
    {
        switch (gettype($data)) {
            case 'array':
                $this->reader = new Reader\ArrayReader();
                break;
            default:
                throw new Exception();
        }
        $this->exporter = new Exporter\PdfExporter();
        $data = $this->reader->parseData($data);
        $document = $this->exporter->createDocument($data);

        return $document;
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