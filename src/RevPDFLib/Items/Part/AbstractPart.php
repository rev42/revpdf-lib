<?php 
namespace RevPDFLib\Items\Part;

use RevPDFLib\Report;
use RevPDFLib\Element;

/**
 * Part
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
abstract class AbstractPart
{
    var $isDisplayed = false;
    var $startposition;
    var $currentPosition;
    var $height;
    var $elements;
    var $isVisible = false;
    var $backgroundColor;
    
    abstract public function getIdentifier();

    public function __construct($data)
    {
        $this->height = $data['height'];
        $this->backgroundColor = $data['backgroundColor'];
        $this->startposition = 0;
    }
    
    public function setIsDisplayed($value)
    {
        $this->isDisplayed = $value;
    }
    
    public function getIsDisplayed()
    {
        return $this->isDisplayed;
    }
    
    public function setStartPosition($value=0)
    {
        $this->startPosition = $value;
    }
    
    public function getStartPosition()
    {
        return $this->startPosition;
    }
    
    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function setElements($elements) {
        foreach ($elements as $element) {
            $newElement = \RevPDFLib\Items\Element\FactoryElement::getFactory($element['type']);
            $newElement->setProperties($element);
            $this->elements[] = $newElement;
        }
    }

    public function getElements() {
        return $this->elements;
    }
    
    public function getCurrentPosition() {
        return $this->currentPosition;
    }

    public function setCurrentPosition($currentPosition) {
        $this->currentPosition = $currentPosition;
    }

    public function getIsVisible() {
        return $this->isVisible;
    }

    public function setIsVisible($isVisible) {
        $this->isVisible = (bool) $isVisible;
    }

}