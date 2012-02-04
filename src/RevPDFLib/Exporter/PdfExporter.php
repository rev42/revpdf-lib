<?php
namespace RevPDFLib\Exporter;

use RevPDFLib\Writer\TfpdfWriter;
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
        $this->sc->register('writer', 'RevPDFLib\Writer\TfpdfWriter');
    }
    
    public function buildDocument(array $data)
    {
        $this->sc->get('writer')->configure($data['report']);
        $this->sc->get('writer')->open();
        $txt = 'Grec : Γειά σου κόσμος';
        $this->sc->get('writer')->write($txt);
        $this->sc->get('writer')->close();
        $this->sc->get('writer')->output();
    }
}