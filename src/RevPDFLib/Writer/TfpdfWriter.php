<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';
require_once BASE_DIR . 'vendors/tfpdf/tFPDF.php';

use \tFPDF;

class TfpdfWriter extends \tFPDF
{
    public function setPageHeaderElements($elements) {
        $this->pageHeaderElements = $elements;
    }
    
    public function getPageHeaderElements() {
        return $this->pageHeaderElements;
    }
    
    public function getLeftMargin()
    {
        return $this->lMargin;
    }
    
    public function getTopMargin()
    {
        return $this->tMargin;
    }
    
    public function header()
    {
        $data = $this->getPageHeaderElements();
        
        if (count($data) <= 0 || $data->getIsVisible() === false) {
            return ;
        }
        //$this->setCurrentPartNumber($data->number);
        // If we have an header, the startPosition is the TopMargin + header height
        //$this->report->getPart('pageHeader')->setStartPosition($this->tMargin);
        // The current position has to be reset at the Top Margin value
        //$this->setCurrentPosition($this->report->getTopMargin());
        $data = $data->getElements();
        if (count($data) <= 0) {
            return false;
        }
        
        foreach ($data as $element) {
            $this->setXY($element['posX'] + $this->getLeftMargin(), $element['posY'] + $this->getTopMargin());
            $this->Cell($element['width'], $element['height'], $element['value']);
        }
    }
}