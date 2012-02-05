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
    const NAME = 'RevPDFLib';
    const VERSION = '2.0.0 (20120129)';
    
    private $sc = null;
    
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('exporter', 'RevPDFLib\Exporter\PdfExporter');
    }
    
    public function selectDataProvider($value)
    {
        $this->sc->register('provider', 'RevPDFLib\DataProvider\\' . $value);
    }
    
    public function export($data)
    {
        switch (gettype($data)) {
            case 'array':
                $this->sc->register('reader', 'RevPDFLib\Reader\ArrayReader');
                break;
            case 'object':
                if (get_class($data) == 'SimpleXMLElement') {
                    $this->sc->register('reader', 'RevPDFLib\Reader\SimpleXMLReader');
                }
                break;
            default:
                throw new Exception();
        }
        // Get data properly formatted
        $report = $this->sc->get('reader')->parseData($data);
        
        // Get data provider
        $this->selectDataProvider($report['source']['provider']);
        $this->sc->get('provider')->parse($report['source']['value']);
        $data = $this->sc->get('provider')->data;
        // Build document and generate it
        $document = null;
        if (is_array($report)) {
            $document = $this->sc->get('exporter')->buildDocument($report, $data);
        }
        return $document;
    }
}