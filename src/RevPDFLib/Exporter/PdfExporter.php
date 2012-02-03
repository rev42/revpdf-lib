<?php
namespace RevPDFLib\Exporter;

use RevPDFLib\Writer\tFPDFWriter;
use RevPDFLib\Writer\TcpdfWriter;

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

/**
 * PDF Exporter
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class PdfExporter
{
    private $sc = null;
    
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('writer', 'RevPDFLib\Writer\tFPDFWriter');
        $this->sc->get('writer')->createDocument();
    }
    
    public function buildDocument()
    {
        
    }
}