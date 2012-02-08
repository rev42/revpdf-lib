<?php 
namespace RevPDFLib\Items\Part;

use RevPDFLib\Items\Part\AbstractPart;

/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class ReportHeader extends AbstractPart
{
    /**
     * RevPDFLib\Items\Part\AbstractPart Report Header constant
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