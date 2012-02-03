<?php 
namespace RevPDFLib;

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

/**
 * RevPDFLib application
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class Application
{
    const VERSION = '2.0.0 (20120129)';
    
    private $sc = null;
    
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('exporter', 'RevPDFLib\Exporter\PdfExporter');
    }
    
    public function export($data)
    {
        switch (gettype($data)) {
            case 'array':
                $this->sc->register('reader', 'RevPDFLib\Reader\ArrayReader');
                break;
            default:
                throw new Exception();
        }
        // Get data properly formatted
        $data = $this->sc->get('reader')->parseData($data);
        
        // Build document and generate it
        $document = $this->sc->get('exporter')->createDocument($data);

        return $document;
    }
}