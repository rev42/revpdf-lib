<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Exporter\PdfExporter;

class PdfExporterTest extends \PHPUnit_Framework_TestCase
{
    protected $exporter;
    
    public function setUp()
    {
        $this->exporter = new PdfExporter();
    }
    
    public function tearDown()
    {
        $this->exporter = null;
    }
}