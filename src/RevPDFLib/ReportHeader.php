<?php 
namespace RevPDFLib;



/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class ReportHeader extends \RevPDFLib\Part
{
    /**
     * Part Report Header constant
     */
    const PART_REPORT_HEADER = 1;
    
    var $height;
    
    public function getIdentifier() {
        return self::PART_REPORT_HEADER;
    }
    
    public function __construct()
    {
    }
}