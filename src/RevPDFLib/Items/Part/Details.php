<?php 
namespace RevPDFLib\Items\Part;

use RevPDFLib\Items\Part\AbstractPart;

/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class Details extends AbstractPart
{
    const PART_HEADER = 0;
    
    public function getIdentifier() {
        return self::PART_HEADER;
    }
}