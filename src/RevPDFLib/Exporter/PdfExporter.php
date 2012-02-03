<?php
namespace RevPDFLib\Exporter;

use RevPDFLib\Writer\tFPDFWriter;
use RevPDFLib\Writer\TcpdfWriter;

/**
 * PDF Exporter
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class PdfExporter
{
    public function __construct()
    {
        $this->writer = new tFPDFWriter();
        $this->writer->createDocument();
    }
    
    public function buildDocument()
    {
        
    }
}