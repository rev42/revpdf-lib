<?php 
namespace RevPDFLib;

class Core
{
    const VERSION = '2.0.0 (20120129)';
    
    private $datasourceType = null;
    
    public function __construct()
    {
        
    }
    
    public function export(array $data)
    {
        exit(1);
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