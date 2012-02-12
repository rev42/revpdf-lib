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

        foreach ($elements as $element) {
            $this->setXY(
                $element->getPosX() + $this->getLeftMargin(),
                $element->getPosY() + $this->getTopMargin()
            );
            $this->Cell(
                $element->getWidth(),
                $element->getHeight(),
                $element->getValue(),
                $element->getBorder()
            );
        }
    }

}