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
use RevPDFLib\Element;

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
    var $isDisplayed = false;
    var $startPosition = 0;
    var $currentPosition = 0;
    var $height = 0;
    var $elements = array();
    var $isVisible = false;
    var $backgroundColor = '#FFF';

    /**
     * Get Part Identifier
     * 
     * @return int 
     */
    abstract public function getIdentifier();

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
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
    
    public function setElements(array $elements) {
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
    
    public function getBackgroundColor() {
        return $this->backgroundColor;
    }

    public function setBackgroundColor($backgroundColor) {
        $this->backgroundColor = $backgroundColor;
    }
}