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

class TfpdfWriter extends \tFPDF
{
    public function setPageHeaderElements($elements) {
        $this->pageHeaderElements = $elements;
    }
    
    public function getPageHeaderElements() {
        return $this->pageHeaderElements;
    }
    
    public function getLeftMargin()
    {
        return $this->lMargin;
    }
    
    public function getTopMargin()
    {
        return $this->tMargin;
    }
    
    public function header()
    {
        $data = $this->getPageHeaderElements();
        
        if (count($data) <= 0 || $data->getIsVisible() === false) {
            return ;
        }
        //$this->setCurrentRevPDFLib\Items\Part\AbstractPartNumber($data->number);
        // If we have an header, the startPosition is the TopMargin + header height
        //$this->report->getPart('pageHeader')->setStartPosition($this->tMargin);
        // The current position has to be reset at the Top Margin value
        //$this->setCurrentPosition($this->report->getTopMargin());
        $data = $data->getElements();
        if (count($data) <= 0) {
            return false;
        }
        
        foreach ($data as $element) {
            $this->setXY($element->getPosX() + $this->getLeftMargin(), $element->getPosY() + $this->getTopMargin());
            $this->Cell($element->getWidth(), $element->getHeight(), $element->getValue());
        }
    }
}