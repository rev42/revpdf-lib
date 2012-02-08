<?php 
namespace RevPDFLib;

/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class PageHeader extends \RevPDFLib\Part
{
    const PART_HEADER = 0;
    
    public function getIdentifier() {
        return self::PART_HEADER;
    }
}