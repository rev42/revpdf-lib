<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tfpdf/tfpdf.php';
require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';

use RevPDFLib\Writer\InterfaceWriter;
use RevPDFLib\Writer\AbstractWriter;
use \tFPDF;

class TfpdfWriter extends AbstractWriter implements InterfaceWriter
{
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        $this->writer = new \tFPDF($pageOrientation, $paperUnit, $paperFormat);
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
        //$this->writer->setEndPosition($report['bottomMargin']);
        //$this->writer->setCurrentPosition($report['topMargin']);
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
    
    public function setPageHeader($data)
    {
        if (is_array($data)) {
            $this->part[\RevPDFLib\Exporter\PdfExporter::PART_HEADER] = $data;
        }
    }
    
    public function getPageHeader()
    {
        return $this->part[\RevPDFLib\Exporter\PdfExporter::PART_HEADER];
    }
    
    public function setReportHeader($data)
    {
        if (is_array($data)) {
            $this->part[\RevPDFLib\Exporter\PdfExporter::PART_REPORT_HEADER] = $data;
        }
    }
    
    public function getReportHeader()
    {
        return $this->part[\RevPDFLib\Exporter\PdfExporter::PART_REPORT_HEADER];
    }
    
    public function header()
    {
        $data = $this->getPageHeader();
        if (count($data) <= 0 || $data['isVisible'] != 1) {
            return ;
        }
        $this->setCurrentPartNumber($data->number);
        // If we have an header, the startPosition is the TopMargin + header height
        //$this->setStartPosition();
        // The current position has to be reset at the Top Margin value
        //$this->setCurrentPosition($this->_report->top_margin);
        $this->writePDF($data['elements']);
    }
    
    public function writePDF($data)
    {
        foreach ($data as $element) {
            $this->writer->setXY($element['posX'], $element['posY']);
            $this->writer->write($element['height'], $element['value']);
        }
    }
    
    public function writeReportHeader()
    {
        $data = $this->getReportHeader();
        $this->writePDF($data['elements']);
    }
}

?>
