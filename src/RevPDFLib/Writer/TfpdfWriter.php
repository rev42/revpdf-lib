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

namespace RevPDFLib\Writer;

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../../../');

require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';
require_once BASE_DIR . 'vendors/tfpdf/tFPDF.php';

use \tFPDF;

/**
 * TfpdfWriter Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Writer
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class TfpdfWriter extends \tFPDF
{
    var $endPosition;
    var $currentPosition;
    
    /**
     * Set Current Position
     * 
     * @param int $value Position
     * 
     * @return void
     */
    public function setCurrentPosition($value)
    {
        $this->currentPosition = $value;
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
     * Get End Position
     * 
     * @return int
     */
    public function getEndPosition()
    {
        return $this->endPosition;
    }

    /**
     * set End Position
     * 
     * @param int $endPosition End Position Y for each page
     * 
     * @return void
     */
    public function setEndPosition($endPosition)
    {
        $this->endPosition = $endPosition;
        /*
        if (!is_null($this->getReport()->getPart('partFooter')) && $this->getReport()->getPart('partFooter')->isVisible() != 0) {
            $this->endPosition = intval($this->writer->h - $endPosition - $this->getReport()->getPart('partFooter')->getHeight());
            $this->SetAutoPageBreak(1, $endPosition + $this->getReport()->getPart('partFooter')->getHeight());
        } else {
            $this->endPosition = intval($this->writer->h - $endPosition);
            $this->SetAutoPageBreak(1, $endPosition);
        }   
         */
    }
    
    /**
     * Set Page Header part
     * 
     * @param array $part Part
     * 
     * @return void
     */
    public function setPageHeader($part)
    {
        $this->pageHeader = $part;
    }

    /**
     * Get Page Header part
     * 
     * @return array
     */
    public function getPageHeader()
    {
        return $this->pageHeader;
    }

    /**
     * Get Left Margin
     * 
     * @return int
     */
    public function getLeftMargin()
    {
        return $this->lMargin;
    }

    /**
     * Get Top Margin
     * 
     * @return int
     */
    public function getTopMargin()
    {
        return $this->tMargin;
    }

    /**
     * Write Report Header
     * 
     * @return boolean 
     */
    public function header()
    {
        $data = $this->getPageHeader();

        if (count($data) <= 0 || $data->isVisible() === false) {
            return;
        }
        
        $elements = $data->getElements();
        
        if (count($elements) <= 0) {
            return false;
        }
        
        $this->setCurrentPosition($this->getTopMargin());

        foreach ($elements as $element) {
            $this->setXY(
                $element->getPosX() + $this->getLeftMargin(),
                $element->getPosY() + $this->getTopMargin()
            );
            $this->Cell(
                $element->getWidth(),
                $element->getHeight(),
                $element->getField(),
                $element->getBorder()
            );
        }
        $newPosition = $this->getTopMargin() + $data->getHeight();
        $this->setCurrentPosition($newPosition);
    }
    
    /**
     * Set text color
     *
     * @param mixed $r     Could be string or int. If string, it must be HTML code
     * @param int   $g     Green value (optional)
     * @param int   $b     Blue value (optional)
     * @param int   $black Black value (optional)
     *
     * @return void
     */
    public function setTextColor($r, $g = -1, $b = -1, $black = -1)
    {
        if (is_string($r)) {
            $this->html2rgb($r, $r, $g, $b);
        }
        parent::SetTextColor($r, $g, $b);
    }
    
    /**
     * Convert HTML color into RGB value
     * Set private properties ($r, $g, $b)
     *
     * @param string $c  HTML color
     * @param int    &$r private property
     * @param int    &$g private property
     * @param int    &$b private property
     *
     * @return void
     */
    protected function html2rgb($c, &$r, &$g, &$b)
    {
        static $colors = array(
          'black' => '#000000',
          'silver' => '#C0C0C0',
          'gray' => '#808080',
          'white' => '#FFFFFF',
          'maroon' => '#800000',
          'red' => '#FF0000',
          'purple' => '#800080',
          'fuchsia' => '#FF00FF',
          'green' => '#008000',
          'lime' => '#00FF00',
          'olive' => '#808000',
          'yellow' => '#FFFF00',
          'navy' => '#000080',
          'blue' => '#0000FF',
          'teal' => '#008080',
          'aqua' => '#00FFFF'
        );

        $c = strtolower($c);
        if (isset($colors[$c])) {
            $c = $colors[$c];
        }
        if ($c{0} != '#') {
            $this->Error('Incorrect color: ' . $c);
        }
        $r = hexdec(substr($c, 1, 2));
        $g = hexdec(substr($c, 3, 2));
        $b = hexdec(substr($c, 5, 2));
    }
    
    /**
     * Set fill color
     *
     * @param mixed $r     Could be string or int. If string, it must be HTML code
     * @param int   $g     Green value (optional)
     * @param int   $b     Blue value (optional)
     * @param int   $black Black value (optional)
     *
     * @return void
     */
    public function setFillColor($r, $g = -1, $b = -1, $black = -1)
    {
        if (is_string($r)) {
            $this->html2rgb($r, $r, $g, $b);
        }
        parent::SetFillColor($r, $g, $b);
    }

}