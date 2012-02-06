<?php
namespace RevPDFLib\Exporter;

use RevPDFLib\Wrapper\TfpdfWrapper;
use RevPDFLib\Wrapper\TcpdfWrapper;

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
        $this->sc->register('writer', 'RevPDFLib\Wrapper\TfpdfWrapper');
    }
    
    public function buildDocument(array $report, array $data)
    {
        $this->sc->register('report', 'RevPDFLib\Report')->addArgument($report);
        $this->sc->get('writer')->setReport($this->sc->get('report'));

        $this->sc->get('writer')->configure($this->sc->get('report')->getAllProperties());
        if (array_key_exists('pageHeader', $report)) {
            $this->sc->register('pageHeader', 'RevPDFLib\PageHeader')->addArgument($report['pageHeader']);
            $this->sc->get('pageHeader')->setStartPosition(intval($this->sc->get('report')->getTopMargin() + $this->sc->get('pageHeader')->getHeight()));
            $this->sc->get('pageHeader')->setElements($report['pageHeader']['elements']);
            $this->sc->get('report')->addPart('pageHeader', $this->sc->get('pageHeader'));
        }
        if (array_key_exists('reportHeader', $report)) {
            $this->sc->register('reportHeader', 'RevPDFLib\ReportHeader')->addArgument($report['reportHeader']);
            $this->sc->get('reportHeader')->setStartPosition(intval($this->sc->get('report')->getTopMargin()));
            $this->sc->get('reportHeader')->setElements($report['reportHeader']['elements']);
            $this->sc->get('report')->addPart('reportHeader', $this->sc->get('reportHeader'));
        }
        if (array_key_exists('details', $report)) {
            $this->sc->register('details', 'RevPDFLib\Part')->addArgument($report['details']);
            $this->sc->get('details')->setStartPosition(intval($this->sc->get('report')->getTopMargin()));
            $this->sc->get('details')->setElements($report['details']['elements']);
            $this->sc->get('report')->addPart('details', $this->sc->get('details'));
        }
        
        $this->sc->get('writer')->openDocument();
        
        $rowsCount = count($data);
        
        for ($i = 0; $i < $rowsCount; $i++) {
            if ($this->sc->get('reportHeader')->getIsDisplayed() === false) {
                $this->sc->get('writer')->writePDF($this->sc->get('reportHeader'), $report['reportHeader']['elements']);
                $this->sc->get('reportHeader')->setIsDisplayed(true);
            }
            if ($report['details']['isVisible'] != 1) {
                return false;
            }
            
            $return = $this->sc->get('writer')->writePDF($this->sc->get('details'), $report['details']['elements']);
            
            if ($return === false) {
                break;
            }
        }
        $this->sc->get('writer')->closeDocument();
        $this->sc->get('writer')->outputDocument();
    }
}