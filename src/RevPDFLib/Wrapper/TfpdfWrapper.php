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

namespace RevPDFLib\Wrapper;

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../../../');

require_once BASE_DIR . 'vendors/tfpdf/font/unifont/ttfonts.php';
require_once BASE_DIR . 'vendors/tfpdf/tFPDF.php';

use RevPDFLib\Wrapper\InterfaceWrapper;
use RevPDFLib\Wrapper\AbstractWrapper;
use RevPDFLib\Writer\TfpdfWriter;
use RevPDFLib\Items\Part\AbstractPart;
use RevPDFLib\Report;
use RevPDFLib\Application;

/**
 * TfpdfWrapper Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Wrapper
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class TfpdfWrapper extends AbstractWrapper implements WrapperInterface
{
    var $currentPosition = 0;
    var $endPosition = 0;
    var $report = null;
    
    /**
     * Constructor
     * 
     * @param string $orientation Page Orientation (Portrait/Landscape)
     * @param string $unit        Paper Unit (mm)
     * @param string $format      Paper Format (A4)
     */
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4')
    {
        $this->writer = new TfpdfWriter($orientation, $unit, $format);
        $this->writer->AddFont('Deja Vu Sans', '', 'DejaVuSans.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'BI', 'DejaVuSans-BoldOblique.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', '', 'DejaVuSerif.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'B', 'DejaVuSerif-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'BI', 'DejaVuSerif-BoldItalic.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'I', 'DejaVuSerif-Italic.ttf', true);
        $this->writer->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->writer->SetFont('DejaVu', '',14);
    }
    
    /**
     * Add Page 
     * 
     * @return void
     */
    public function addPage()
    {
        $this->writer->AddPage();
    }

    /**
     * Configure Report
     * 
     * @param array $report Report
     * 
     * @return void
     */
    public function configure($report)
    {
        if (!is_null($this->getReport()->getPart('partFooter')) && $this->getReport()->getPart('partFooter')->isVisible() != 0) {
            $this->writer->setEndPosition(intval($this->writer->h - $report['bottomMargin'] - $this->getReport()->getPart('partFooter')->getHeight()));
            $this->writer->SetAutoPageBreak(1, $report['bottomMargin'] + $this->getReport()->getPart('partFooter')->getHeight());
        } else {
            $this->writer->setEndPosition(intval($this->writer->h - $report['bottomMargin']));
            $this->writer->SetAutoPageBreak(1, $report['bottomMargin']);
        }
        $this->writer->setCurrentPosition($report['topMargin']);
        $this->writer->SetAuthor($report['author']);
        $this->writer->SetCreator(Application::NAME);
        $this->writer->SetDisplayMode(
            $report['displayModeZoom'], 
            $report['displayModeLayout']
        );
        $this->writer->SetKeywords($report['keywords']);
        $this->writer->SetSubject($report['subject']);
        $this->writer->SetTitle($report['title']);
        $this->writer->SetMargins(
            $report['leftMargin'],
            $report['topMargin'],
            $report['rightMargin']
        );
        // Page header is a special part because it is automatically called when
        // a new page is created. header() doesn't support parameters
        $this->writer->setPageHeader($this->getReport()->getPart('pageHeader'));
        $this->writer->SetTopMargin($this->getReport()->getTopMargin());
        $this->writer->SetLeftMargin($this->getReport()->getLeftMargin());
    }
    
    /**
     * Output Document
     * 
     * @return void
     */
    public function output()
    {
        $this->writer->Output();
    }
    
    /**
     * Open Document 
     * 
     * @return void
     */
    public function openDocument()
    {
        $this->writer->Open();
        $this->writer->AddPage();
    }
    
    /**
     * Close Document 
     * 
     * @return void
     */
    public function closeDocument()
    {
        
    }
    
    /**
     * Output Document
     * 
     * @return void
     */
    public function outputDocument()
    {
        $this->writer->Output();
    }
    
    /**
     * Set Current Part Number
     * 
     * @param int $value Value
     * 
     * @return void
     */
    public function setCurrentPartNumber($value)
    {
        $this->currentPartNumber = $value;
    }
    
    /**
     * Get Current Part Number
     * 
     * @return int
     */
    public function getCurrentPartNumber()
    {
        return $this->currentPartNumber;
    }
    
    /**
     * Write Elements into document
     * 
     * @param \RevPDFLib\Items\Part\AbstractPart $part Part
     * @param array                              $data Data
     * 
     * @return boolean 
     */
    public function writePDF(AbstractPart $part, array $data)
    {
        if (count($data) <= 0) {
            return false;
        }

        foreach ($data as $element) {
            // Create new page if overlapping
            if (intval($this->writer->getCurrentPosition() + $element->getHeight()) >= intval($this->writer->getEndPosition())) {
                $this->writer->AddPage($this->report->getPageOrientation());
                $this->writer->setCurrentPosition($part->getStartPosition());
            }
                
            $this->writer->setXY(
                $element->getPosX() + $this->getReport()->getLeftMargin(), 
                $element->getPosY() + $this->writer->getCurrentPosition()
            );
            $this->writer->Cell(
                $element->getWidth(),
                $element->getHeight(),
                //$element->getValue(),
                $element->getPosY() + $this->writer->getCurrentPosition().' - '.$element->getHeight(),
                $element->getBorder()
            );
        }
        
        $newPosition = $this->writer->getCurrentPosition() + $part->getHeight();
        $this->writer->setCurrentPosition($newPosition);
        
        return true;
    }

    /**
     * Set Report
     * 
     * @param \RevPDFLib\Report $report Report
     * 
     * @return void
     */
    public function setReport(Report $report)
    {
        $this->report = $report;
    }
    
    /**
     * Get Report
     * 
     * @return Report
     */
    public function getReport()
    {
        return $this->report;
    }
    
    /**
     * Alias Nb Pages 
     * 
     * @param string $alias Alias
     * 
     * @return void
     */
    public function aliasNbPages($alias='{nb}')
    {
        $this->writer->AliasNbPages($alias);
    }
}

?>
