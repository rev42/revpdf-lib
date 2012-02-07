<?php 
namespace RevPDFLib;

/**
 * Report
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class Report
{
    /**
     * Part Header constant
     */
    const PART_HEADER = 0;

    /**
     * Part Report Header constant
     */
    const PART_REPORT_HEADER = 1;

    /**
     * Part Group Header constant
     */
    const PART_GROUP_HEADER = 2;

    /**
     * Part Data constant
     */
    const PART_DATA = 3;

    /**
     * Part Group Footer constant
     */
    const PART_GROUP_FOOTER = 4;

    /**
     * Part Footer constant
     */
    const PART_FOOTER = 5;

    /**
     * Part Report Footer constant
     */
    const PART_REPORT_FOOTER = 6;
    
    var $author;
    var $displayModeZoom;
    var $displayModeLayout;
    var $keywords;
    var $subject;
    var $title;
    var $leftMargin;
    var $topMargin;
    var $rightMargin;
    var $bottomMargin;
    var $pageOrientation;
    
    public function __construct($data)
    {
        $this->author = $data['report']['author'];
        $this->displayModeZoom = $data['report']['displayModeZoom'];
        $this->displayModeLayout = $data['report']['displayModeLayout'];
        $this->keywords = $data['report']['keywords'];
        $this->subject = $data['report']['subject'];
        $this->title = $data['report']['title'];
        $this->leftMargin = $data['report']['leftMargin'];
        $this->topMargin = $data['report']['topMargin'];
        $this->rightMargin = $data['report']['rightMargin'];
        $this->bottomMargin = $data['report']['bottomMargin'];
    }
    
    public function initializeParts()
    {
        if (count($this->parts) <= 0) {
            return true;
        }
        
        
        foreach ($this->parts as $type => $part) {
            if ($type == 'pageHeader') {
                $part->setStartPosition($this->getTopMargin());
            } elseif ($type == 'reportHeader') {
                if ($this->parts['pageHeader']->getIsVisible() === true) {
                    $offset = $this->parts['pageHeader']->getHeight();
                } else {
                    $offset = 0;
                }
                $part->setStartPosition($this->getTopMargin() + $offset);
            } elseif ($type == 'details') {
                if ($this->parts['pageHeader']->getIsVisible() === true) {
                    $offset = $this->parts['pageHeader']->getHeight();
                } else {
                    $offset = 0;
                }
                if ($this->parts['reportHeader']->getIsVisible() === true) {
                    $offset += $this->parts['reportHeader']->getHeight();
                }
                $part->setStartPosition($this->getTopMargin() + $offset);
            }
        }
    }
    
    public function getAllProperties()
    {
        return get_object_vars($this);
    }
    
    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getDisplayModeZoom() {
        return $this->displayModeZoom;
    }

    public function setDisplayModeZoom($displayModeZoom) {
        $this->displayModeZoom = $displayModeZoom;
    }

    public function getDisplayModeLayout() {
        return $this->displayModeLayout;
    }

    public function setDisplayModeLayout($displayModeLayout) {
        $this->displayModeLayout = $displayModeLayout;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getLeftMargin() {
        return $this->leftMargin;
    }

    public function setLeftMargin($leftMargin) {
        $this->leftMargin = $leftMargin;
    }

    public function getTopMargin() {
        return $this->topMargin;
    }

    public function setTopMargin($topMargin) {
        $this->topMargin = $topMargin;
    }

    public function getRightMargin() {
        return $this->rightMargin;
    }

    public function setRightMargin($rightMargin) {
        $this->rightMargin = $rightMargin;
    }

    public function getBottomMargin() {
        return $this->bottomMargin;
    }

    public function setBottomMargin($bottomMargin) {
        $this->bottomMargin = $bottomMargin;
    }
    
    public function getPageOrientation() {
        return $this->pageOrientation;
    }

    public function setPageOrientation($pageOrientation) {
        $this->pageOrientation = $pageOrientation;
    }

    public function addPart($type, \RevPDFLib\Part $object)
    {
        $this->parts[$type] = $object;
    }
    
    public function getPart($type)
    {
        if (isset($this->parts[$type])) {
            return $this->parts[$type];
        } else {
            return null;
        }
    }

}