<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tcpdf/tcpdf.php';

use RevPDFLib\Writer\InterfaceWriter;


class TcpdfWriter extends \TCPDF implements InterfaceWriter
{
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        parent::__construct($pageOrientation, $paperUnit, $paperFormat, true, 'UTF-8', false);
    }
    
    public function createDocument()
    {
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Nicola Asuni');
        $this->SetTitle('TCPDF Example 002');
        $this->SetSubject('TCPDF Tutorial');
        $this->SetKeywords('TCPDF, PDF, example, test, guide');
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $this->SetFont('times', 'BI', 20);

        // add a page
        $this->AddPage();

        
        $html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;
        $this->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

        $this->Output();
    }
}