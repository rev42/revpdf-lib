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

class TfpdfWrapper extends AbstractWrapper implements WrapperInterface
{
    var $currentPosition = 0;
    var $endPosition = 0;
    var $report = null;
    
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        $this->writer = new \RevPDFLib\Writer\TfpdfWriter($pageOrientation, $paperUnit, $paperFormat);
        $this->writer->AddFont('Deja Vu Sans', '', 'DejaVuSans.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'BI', 'DejaVuSans-BoldOblique.ttf', true);
        $this->writer->AddFont('Deja Vu Sans', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', '', 'DejaVuSerif.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'B', 'DejaVuSerif-Bold.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'BI', 'DejaVuSerif-BoldItalic.ttf', true);
        $this->writer->AddFont('Deja Vu Serif', 'I', 'DejaVuSerif-Italic.ttf', true);
        $this->writer->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->writer->SetFont('DejaVu','',14);
    }
    
    public function addPage()
    {
        $this->writer->AddPage();
    }
    
    public function configure($report)
    {
        $this->setEndPosition($report['bottomMargin']);
        $this->setCurrentPosition($report['topMargin']);
        $this->writer->SetAuthor($report['author']);
        $this->writer->SetCreator(\RevPDFLib\Application::NAME);
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
        $this->writer->setPageHeaderElements($this->getReport()->getPart('pageHeader'));
        $this->writer->SetTopMargin($this->getReport()->getTopMargin());
        $this->writer->SetLeftMargin($this->getReport()->getLeftMargin());
    }
    
    public function output()
    {
        $this->writer->Output();
    }
    
    public function openDocument()
    {
        $this->writer->Open();
        $this->writer->AddPage();
    }
    
    public function closeDocument()
    {
        
    }
    
    public function outputDocument()
    {
        $this->writer->Output();
    }
    
    public function setCurrentPartNumber($value)
    {
        $this->currentPartNumber = $value;
    }
    
    public function getCurrentPartNumber()
    {
        return $this->currentPartNumber;
    }
    
    public function writePDF(\RevPDFLib\Items\Part\AbstractPart $part, array $data)
    {
        if (count($data) <= 0) {
            return false;
        }
        
        // Set current position at Part start position
        $this->setCurrentPosition($part->getStartPosition());
        
        foreach ($data as $element) {
            // Create new page if overlapping
            if ($this->getCurrentPosition() + $element->getHeight() >= $this->getEndPosition()) {
                $this->writer->AddPage($this->report->getPageOrientation());
                $this->setCurrentPosition($part->getStartPosition());
            }
            
            $this->writer->setXY($element->getPosX() + $this->getReport()->getLeftMargin(), $element->getPosY() + $this->getCurrentPosition());
            $this->writer->Cell($element->getWidth(), $element->getHeight(), $element->getValue());
        }
        
        return true;
    }
    
    public function setCurrentPosition($value)
    {
        $this->currentPosition = $value;
    }
    
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }
    public function getEndPosition()
    {
        return $this->endPosition;
    }

    public function setEndPosition($endPosition)
    {
        if (!is_null($this->getReport()->getPart('partFooter')) && $this->getReport()->getPart('partFooter')->getIsVisible() != 0) {
            $this->endPosition = intval($this->writer->h - $endPosition - $this->getReport()->getPart('partFooter')->getHeight());
            $this->writer->SetAutoPageBreak(1, $endPosition + $this->getReport()->getPart('partFooter')->getHeight());
        } else {
            $this->endPosition = intval($this->writer->h - $endPosition);
            $this->writer->SetAutoPageBreak(1, $endPosition);
        }
    }
    
    public function setReport(\RevPDFLib\Report $report)
    {
        $this->report = $report;
    }
    
    public function getReport()
    {
        return $this->report;
    }
}

?>
