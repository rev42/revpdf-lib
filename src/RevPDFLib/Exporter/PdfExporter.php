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
    /**
     * Part Header constant
     */
    const PART_HEADER = 0;

    /**
     * Part Report Header constant
     */
    const PART_REPORT_HEADER = 1;

    /**
     * Part Group Header constant
     */
    const PART_GROUP_HEADER = 2;

    /**
     * Part Data constant
     */
    const PART_DATA = 3;

    /**
     * Part Group Footer constant
     */
    const PART_GROUP_FOOTER = 4;

    /**
     * Part Footer constant
     */
    const PART_FOOTER = 5;

    /**
     * Part Report Footer constant
     */
    const PART_REPORT_FOOTER = 6;
    
    private $sc = null;
    
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('writer', 'RevPDFLib\Writer\TfpdfWriter');
    }
    
    public function buildDocument(array $report, array $data)
    {
        $this->sc->get('writer')->configure($report);
        $this->sc->get('writer')->openDocument();
        
        $rowsCount = count($data);
        
        for ($i = 0; $i < $rowsCount; $i++) {
            if ($this->sc->get('writer')->getReportHeaderDisplayed() === false) {
                $this->sc->get('writer')->writeReportHeader();
            }
            $this->sc->get('writer')->writeDetails();
        }
        $this->sc->get('writer')->closeDocument();
        $this->sc->get('writer')->outputDocument();
    }
}