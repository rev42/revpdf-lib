<?php
namespace RevPDFLib\Writer;

use RevPDFLib\Writer\InterfaceWriter;
use Tfpdf\tFPDF;

class tFPDFWriter extends tFPDF implements InterfaceWriter
{
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        parent::tFPDF($pageOrientation, $paperUnit, $paperFormat);
        $this->AddFont('Deja Vu Sans', '', 'DejaVuSans.ttf', true);
        $this->AddFont('Deja Vu Sans', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->AddFont('Deja Vu Sans', 'BI', 'DejaVuSans-BoldOblique.ttf', true);
        $this->AddFont('Deja Vu Sans', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->AddFont('Deja Vu Serif', '', 'DejaVuSerif.ttf', true);
        $this->AddFont('Deja Vu Serif', 'B', 'DejaVuSerif-Bold.ttf', true);
        $this->AddFont('Deja Vu Serif', 'BI', 'DejaVuSerif-BoldItalic.ttf', true);
        $this->AddFont('Deja Vu Serif', 'I', 'DejaVuSerif-Italic.ttf', true);
    }
    
    public function createDocument($data)
    {
        
    }
}

?>
