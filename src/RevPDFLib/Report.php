<?php 
namespace RevPDFLib;

use Symfony\Component\EventDispatcher\EventDispatcher;

use RevPDFLib\Listener\PartListener;
use RevPDFLib\Event\AddPartEvent;

/**
 * Report
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class Report
{
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
    
    protected $author;
    protected $displayModeZoom;
    protected $displayModeLayout;
    protected $keywords;
    protected $subject;
    protected $title;
    protected $leftMargin;
    protected $topMargin;
    protected $rightMargin;
    protected $bottomMargin;
    protected $pageOrientation;
    protected $parts = array();
    
    protected $dispatcher;
    
    public function __construct($data)
    {
        $this->dispatcher = new EventDispatcher();
        $this->dispatcher->addSubscriber(new PartListener());

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
        $this->pageOrientation = $data['report']['pageOrientation'];
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
        $this->leftMargin = (int) $leftMargin;
    }

    public function getTopMargin() {
        return $this->topMargin;
    }

    public function setTopMargin($topMargin) {
        $this->topMargin = (int) $topMargin;
    }

    public function getRightMargin() {
        return $this->rightMargin;
    }

    public function setRightMargin($rightMargin) {
        $this->rightMargin = (int) $rightMargin;
    }

    public function getBottomMargin() {
        return $this->bottomMargin;
    }

    public function setBottomMargin($bottomMargin) {
        $this->bottomMargin = (int) $bottomMargin;
    }
    
    public function getPageOrientation() {
        return $this->pageOrientation;
    }

    public function setPageOrientation($pageOrientation) {
        $this->pageOrientation = 'P';
        
        if (in_array($pageOrientation, array('P', 'L'))) {
            $this->pageOrientation = $pageOrientation;
        }
    }

    public function addPart($type, \RevPDFLib\Items\Part\AbstractPart $part)
    {
        $this->parts[$type] = $part;
        switch($type) {
            case 'PageHeader':
                $offset = $this->getTopMargin();
                break;
            case 'ReportHeader':
                $offset = $this->getTopMargin() + $this->getPart('PageHeader')->getStartPosition();
                break;
            default:
                $offset = 0;
                break;
        }
        $this->dispatcher->dispatch('response', new AddPartEvent($part, $offset));
    }
    
    public function getParts()
    {
        return $this->parts;
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