<?php
namespace RevPDFLib\Exporter;

use RevPDFLib\Exporter\tFPDFExporter;

class PdfExporter
{
    public function __construct()
    {
        $this->writer = new tFPDFExporter();
        $this->buildDocument();
    }
    
    public function buildDocument()
    {
        $this->writer->AddPage();

        // Ajoute une police Unicode (utilise UTF-8)
        $this->writer->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->writer->SetFont('DejaVu','',14);

        // Charge une cha�ne UTF-8 � partir d'un fichier
        $txt = 'Grec : Γειά σου κόσμος';
        $this->writer->Write(8,$txt);

        // S�lectionne une police standard (utilise windows-1252)
        $this->writer->SetFont('Arial','',14);
        $this->writer->Ln(10);
        $this->writer->Write(5,"La taille de ce PDF n'est que de 17 ko.");

        $this->writer->Output();
    }
}