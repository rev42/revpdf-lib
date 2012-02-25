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

use RevPDFLib\Wrapper\InterfaceWrapper;
use RevPDFLib\Wrapper\AbstractWrapper;
use RevPDFLib\Writer\TfpdfWriter;
use RevPDFLib\Items\Part\AbstractPart;
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
    
    public function __construct(\RevPDFLib\Writer\WriterInterface $writer)
    {
        $this->writer = $writer;
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
        // Page header/footer are special parts because they are automatically 
        // called when new page is created. header() and footer() doesn't 
        // support parameters
        $this->writer->setPageHeader($this->getReport()->getPart('pageHeader'));
        $this->writer->setPageFooter($this->getReport()->getPart('pageFooter'));
        $this->writer->SetTopMargin($this->getReport()->getTopMargin());
        $this->writer->SetLeftMargin($this->getReport()->getLeftMargin());
        $this->writer->setEndPosition($report['bottomMargin']);
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
        $this->writer->AddPage($this->getReport()->getPageOrientation());
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
     * Write Elements into document
     * 
     * @param \RevPDFLib\Items\Part\AbstractPart $part Part
     * @param array                              $data Data
     * 
     * @return boolean 
     */
    public function writePDF(AbstractPart $part, array $data, $iterator=null)
    {
        if (count($data) <= 0 || $part->isVisible() === false) {
            return false;
        }

        foreach ($data as $element) {
            // Create new page if overlapping
            if (intval($this->writer->getCurrentPosition() + $element->getHeight()) >= intval($this->writer->getEndPosition())) {
                //echo $this->writer->getCurrentPosition() + $element->getHeight() . "/" . intval($this->writer->getEndPosition());exit;
                $this->writer->AddPage($this->report->getPageOrientation());
                $this->writer->setCurrentPosition($part->getStartPosition());
            }
            $this->writer->SetLineWidth($element->getBorderWidth());
            $this->writer->setFillColor($element->getFillColor());
            $this->writer->setTextColor($element->getTextColor());
            $this->writer->SetFont($element->getFont(), $element->getStyle(), $element->getFontSize());
            $this->writer->setXY(
                $element->getPosX() + $this->getReport()->getLeftMargin(), 
                $element->getPosY() + $this->writer->getCurrentPosition()
            );
            
            $element->writeContent($this->writer, $iterator);

            $this->writer->Cell(
                $element->getWidth(),
                $element->getHeight(),
                $element->getField($iterator),
                //$this->writer->getCurrentPosition() ."+". $element->getHeight().' - '.$this->writer->getEndPosition(),
                $element->getBorder(),
                0,
                $element->getAlignment(),
                true
            );
        }
        
        $newPosition = $this->writer->getCurrentPosition() + $part->getHeight();
        $this->writer->setCurrentPosition($newPosition);
        
        // Add page jump if set
        if ($part->isPageJump() 
        && !($part instanceof \RevPDFLib\Items\Part\PageHeader)
        ) {
            $this->writer->AddPage($this->getReport()->getPageOrientation());
            $this->writer->setCurrentPosition($part->getStartPosition());
        }
        
        return true;
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
