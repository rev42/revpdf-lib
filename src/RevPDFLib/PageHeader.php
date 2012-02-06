<?php 
namespace RevPDFLib;



/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class PageHeader extends \RevPDFLib\Part
{
    var $number = \RevPDFLib\Report::PART_HEADER;
    
    public function __construct()
    {
    }
    
    public function setStartPosition($value=0)
    {
        if ($this->getIsVisible()) {
            $this->startPosition = intval($value + $this->getHeight());
        } else {
            $this->startPosition = intval($value);
        }
    }
}