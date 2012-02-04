<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tcpdf/tcpdf.php';

use RevPDFLib\Writer\InterfaceWriter;
use RevPDFLib\Writer\AbstractWriter;
use \TCPDF;

class TcpdfWriter extends AbstractWriter implements InterfaceWriter
{
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        $this->writer = new \TCPDF($pageOrientation, $paperUnit, $paperFormat, true, 'UTF-8', false);
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
        
        $this->writer->setPrintHeader(false);
        $this->writer->setPrintFooter(false);
        
        $this->writer->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        //set auto page breaks
        $this->writer->SetAutoPageBreak(TRUE, $report['bottomMargin']);

        //set image scale factor
        $this->writer->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $this->writer->SetFont('times', 'BI', 20);
    }
    
    public function output()
    {
        $this->writer->Output();
    }
    
    public function write($value)
    {
        $this->writer->writeHTMLCell($w=0, $h=0, $x='', $y='', $value, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
    }
    
    public function open()
    {
        $this->writer->AddPage();
    }
    
    public function close()
    {
        
    }
}