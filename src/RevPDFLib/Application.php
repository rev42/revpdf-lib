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
        $data = $this->sc->get('reader')->parseData($data);
        
        // Get data provider
        $this->selectDataProvider($data['source']['provider']);
        $this->sc->get('provider')->parse($data['source']['value']);
        print_r($this->sc->get('provider')->data);exit;
        // Build document and generate it
        $document = null;
        if (is_array($data)) {
            $document = $this->sc->get('exporter')->buildDocument($data);
        }
        return $document;
    }
}