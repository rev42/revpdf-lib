<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tfpdf/tfpdf.php';
require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';

use RevPDFLib\Writer\InterfaceWriter;

class tFPDFWriter extends \tFPDF implements InterfaceWriter
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
    
    public function createDocument()
    {
        $this->AddPage();

        // Ajoute une police Unicode (utilise UTF-8)
        $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->SetFont('DejaVu','',14);

        // Charge une cha�ne UTF-8 � partir d'un fichier
        $txt = 'Grec : Γειά σου κόσμος';
        $this->Write(8,$txt);

        // S�lectionne une police standard (utilise windows-1252)
        $this->SetFont('Arial','',14);
        $this->Ln(10);
        $this->Write(5,"La taille de ce PDF n'est que de 17 ko.");

        $this->Output();
    }
}

?>
