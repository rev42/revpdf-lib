<?php

/**
 * $Id:$
 *
 * PHP version 5
 *
 * @category  PDF
 * @package   RevPDFLib
 * @author    Olivier Cornu <contact@revpdf.org>
 * @copyright 2007-2010 Olivier Cornu
 * @license   GNU General Public License v3.0
 * @version   SVN: $Id:$
 * @link      http://www.revpdf.org
 *
 * This package can be redistributed and/or modified
 * under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This package is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License; if not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace RevPDFLib\Items\Part;

use RevPDFLib\Report;
use RevPDFLib\Items\Element\FactoryElement;

/**
 * Part Abstract Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
abstract class AbstractPart
{
    /*
    const PART_HEADER = 0;
    const PART_REPORT_HEADER = 1;
    const PART_GROUP_HEADER = 2;
    const PART_DATA = 3;
    const PART_GROUP_FOOTER = 4;
    const PART_FOOTER = 5;
    const PART_REPORT_FOOTER = 6;
    */
    protected $partIds = array(
        'header',
        'reportHeader',
        'groupHeader',
        'data',
        'groupFooter',
        'reportFooter',
        'footer'
    );
    
    /**
     * Is Displayed
     * @var boolean
     */
    protected $isDisplayed = false;

    /**
     * Start Position
     * @var int
     */
    protected $startPosition = 0;

    /**
     * Current Position
     * @var int
     */
    protected $currentPosition = 0;
    protected $elements = array();
    protected $identifier = null;
    
    protected $height;
    protected $isVisible;
    protected $backgroundColor;
    protected $isPageJump;
    
    /**
     * Constructor
     * 
     * @param array $data Data
     */
    public function __construct(array $data)
    {
        $defaults = array(
            'height' => 0,
            'isVisible' => false,
            'backgroundColor' => '#FFF',
            'isPageJump' => false,
        );
        $data = array_merge($defaults, $data);
        $this->height = $data['height'];
        $this->isVisible = (boolean) $data['isVisible'];
        $this->backgroundColor = $data['backgroundColor'];
        $this->isPageJump = (boolean) $data['isPageJump'];

        if (isset($data['elements'])) {
            $this->setElements($data['elements']);
        }
    }

    /**
     * Get Part Identifier
     * 
     * @return int 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set Is Displayed
     * 
     * @param boolean $value Value
     * 
     * @return void
     */
    public function setIsDisplayed($value)
    {
        $this->isDisplayed = $value;
    }

    /**
     * Get Is Displayed
     * 
     * @return boolean 
     */
    public function isDisplayed()
    {
        return $this->isDisplayed;
    }

    /**
     * Set Start Position
     * 
     * @param int $value Value
     * 
     * @return void
     */
    public function setStartPosition($value = 0)
    {
        $this->startPosition = $value;
    }

    /**
     * Get Start Position
     * 
     * @return int
     */
    public function getStartPosition()
    {
        return $this->startPosition;
    }

    /**
     * Get Height
     * 
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set Height
     * 
     * @param int $height Height value
     * 
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Set Elements
     * 
     * @param array $elements Elements
     * 
     * @return void
     */
    public function setElements(array $elements)
    {
        $this->elements = array();
        foreach ($elements as $element) {
            $newElement = FactoryElement::getFactory($element['type']);
            $newElement->setProperties($element);
            $this->elements[] = $newElement;
        }
    }

    /**
     * Get Elements
     * 
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Get Current Position
     * 
     * @return int
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    /**
     * Set Current Position
     * 
     * @param int $currentPosition Current Position
     * 
     * @return void
     */
    public function setCurrentPosition($currentPosition)
    {
        $this->currentPosition = $currentPosition;
    }

    /**
     * Get Is Visible
     * 
     * @return boolean
     */
    public function isVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set Is Visible
     * 
     * @param boolean $isVisible Visible (true/false)
     * 
     * @return void
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = (bool) $isVisible;
    }

    /**
     * Get Background Color
     * 
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set Background Color
     * 
     * @param string $backgroundColor Background Color (#FFF)
     * 
     * @return void
     */
    public function setBackgroundColor($backgroundColor)
    {
        if ($backgroundColor[0] != '#') {
            $backgroundColor = "#" . $backgroundColor;
        }
        $this->backgroundColor = $backgroundColor;
    }
    
    /**
     * Get Page Jump
     * 
     * @return boolean
     */
    public function isPageJump() 
    {
        return (bool) $this->isPageJump;
    }
    
    /**
     * Set Page Jump
     * 
     * @param boolean $isPageJump isPageJump
     * 
     * @return void
     */
    public function setIsPageJump($isPageJump)
    {
        $this->isPageJump = (bool) $isPageJump;
    }
}