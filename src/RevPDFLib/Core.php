<?php 
namespace RevPDFLib;

class Core
{
    const VERSION = '2.0.0 (20120129)';
    
    public function __construct()
    {
        
    }
    
    public function export(array $data)
    {
        
    }
    
    public function setDatasource($value)
    {
        $this->datasource = (string) $value;
    }
    
    public function getDatasource()
    {
        return $this->datasource;
    }
}