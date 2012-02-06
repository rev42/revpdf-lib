<?php 
namespace RevPDFLib;



/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class ReportHeader extends \RevPDFLib\Part
{
    var $number = \RevPDFLib\Report::PART_REPORT_HEADER;
    var $height;
    
    public function __construct()
    {
    }
}