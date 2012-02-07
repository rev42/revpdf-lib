<?php
namespace RevPDFLib\Wrapper;

require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';
require_once BASE_DIR . 'vendors/tfpdf/tFPDF.php';

use RevPDFLib\Wrapper\InterfaceWrapper;
use RevPDFLib\Wrapper\AbstractWrapper;
use RevPDFLib\Writer\TfpdfWriter;

class TfpdfWrapper extends AbstractWrapper implements InterfaceWrapper
{
    var $currentPosition = 0;
    var $endPosition = 0;
    var $report = null;
    
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        $this->writer = new \RevPDFLib\Writer\TfpdfWriter($pageOrientation, $paperUnit, $paperFormat);
        $this->writer->AddFont('Deja Vu Sans', '', 'DejaVuSans.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'BI', 'DejaVuSans-BoldOblique.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', '', 'DejaVuSerif.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'B', 'DejaVuSerif-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'BI', 'DejaVuSerif-BoldItalic.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'I', 'DejaVuSerif-Italic.ttf', true);
        $this->writer->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->writer->SetFont('DejaVu','',14);
    }
    
    public function addPage()
    {
        $this->writer->AddPage();
    }
    
    public function configure($report)
    {
        $this->setEndPosition($report['bottomMargin']);
        $this->setCurrentPosition($report['topMargin']);
        $this->writer->SetAuthor($report['author']);
        $this->writer->SetCreator(\RevPDFLib\Application::NAME);
        $this->writer->SetDisplayMode(
            $report['displayModeZoom'], 
            $report['displayModeLayout']
        );
        $this->writer->SetKeywords($report['keywords']);
        $this->writer->SetSubject($report['subject']);
        $this->writer->SetTitle($report['title']);
        $this->writer->SetMargins(
            $report['leftMargin'],
            $report['topMargin'],
            $report['rightMargin']
        );
        $this->writer->setPageHeaderElements($this->getReport()->getPart('pageHeader'));
        $this->writer->SetTopMargin($this->getReport()->getTopMargin());
        $this->writer->SetLeftMargin($this->getReport()->getLeftMargin());
    }
    
    public function output()
    {
        $this->writer->Output();
    }
    
    public function openDocument()
    {
        $this->writer->Open();
        $this->writer->AddPage();
    }
    
    public function closeDocument()
    {
        
    }
    
    public function outputDocument()
    {
        $this->writer->Output();
    }
    
    public function setCurrentPartNumber($value)
    {
        $this->currentPartNumber = $value;
    }
    
    public function getCurrentPartNumber()
    {
        return $this->currentPartNumber;
    }
    
    public function writePDF(\RevPDFLib\Part $part, array $data)
    {
        if (count($data) <= 0) {
            return false;
        }
        
        $this->setCurrentPosition($part->getStartPosition());
        
        foreach ($data as $element) {
            // Create new page if overlapping
            if ($this->getCurrentPosition() + $element['height'] >= $this->getEndPosition()) {
                $this->writer->AddPage($this->report->getPageOrientation());
                $this->setCurrentPosition($part->getStartPosition());
            }
            
            $this->writer->setXY($element['posX'] + $this->getReport()->getLeftMargin(), $element['posY']+ $this->getCurrentPosition());
            $this->writer->write($element['height'], $element['value']);
        }
        
        return true;
    }
    
    public function setCurrentPosition($value)
    {
        $this->currentPosition = $value;
    }
    
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }
    public function getEndPosition()
    {
        return $this->endPosition;
    }

    public function setEndPosition($endPosition)
    {
        if (!is_null($this->getReport()->getPart('partFooter')) && $this->getReport()->getPart('partFooter')->getIsVisible() != 0) {
            $this->endPosition = intval($this->writer->h - $endPosition - $this->getReport()->getPart('partFooter')->getHeight());
            $this->writer->SetAutoPageBreak(1, $endPosition + $this->getReport()->getPart('partFooter')->getHeight());
        } else {
            $this->endPosition = intval($this->writer->h - $endPosition);
            $this->writer->SetAutoPageBreak(1, $endPosition);
        }
    }
    
    public function setReport(\RevPDFLib\Report $report)
    {
        $this->report = $report;
    }
    
    public function getReport()
    {
        return $this->report;
    }
}

?>
