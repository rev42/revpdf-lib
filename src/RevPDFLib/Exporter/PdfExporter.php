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

namespace RevPDFLib\Exporter;

use RevPDFLib\Wrapper\WrapperInterface;
use RevPDFLib\Report;
use RevPDFLib\Items\Part;

/**
 * PdfExporter Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Exporter
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class PdfExporter
{
    protected $wrapper = null;
    protected $report = null;
    protected $recordIterator = null;

    /**
     * Constructor
     * 
     * @param RevPDFLib\Wrapper\WrapperInterface $wrapper Wrapper
     * @param RevPDFLib\Report                   $report  Report
     * 
     * @return void
     */
    public function __construct(WrapperInterface $wrapper, Report $report)
    {
        $this->wrapper = $wrapper;
        $this->wrapper->setReport($report);
        $this->report = $report;
    }
    
    /**
     * Get Wrapper
     * 
     * @return RevPDFLib\Wrapper\WrapperInterface 
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Set Wrapper 
     * 
     * @param RevPDFLib\Wrapper\WrapperInterface $wrapper Wrapper
     * 
     * @return void
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * Get Report
     * 
     * @return RevPDF\Report 
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set Report
     * 
     * @param RevPDF\Report $report Report
     * 
     * @return void
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

        
    /**
     * Configure report object by setting properties and adding parts
     * 
     * @param array $reportData Data
     * 
     * @return void 
     */
    public function buildDocument(array $reportData)
    {
        $this->report->setAllProperties($reportData);
        
        if (array_key_exists('pageHeader', $reportData)) {
            $part = new Part\PageHeader($reportData['pageHeader']);
            
            $this->report->addPart('pageHeader', $part);
        }
        if (array_key_exists('reportHeader', $reportData)) {
            $part = new Part\ReportHeader($reportData['reportHeader']);
            
            $this->report->addPart('reportheader', $part);
        }
        if (array_key_exists('details', $reportData)
            && count($reportData['details']) > 0
        ) {
            $part = new Part\Details($reportData['details']);
            
            $this->report->addPart('details', $part);
        }
        if (array_key_exists('reportFooter', $reportData)) {
            $part = new Part\ReportFooter($reportData['reportFooter']);
            
            $this->report->addPart('reportFooter', $part);
        }
        if (array_key_exists('pageFooter', $reportData)) {
            $part = new Part\PageFooter($reportData['pageFooter']);
            
            $this->report->addPart('pageFooter', $part);
        }
        
        $this->wrapper->configure($this->report->getAllProperties());
    }
    
    /**
     * Generate document
     * 
     * @param array $data Data
     * 
     * @return boolean 
     */
    public function generateDocument($data)
    {
        $object = new \ArrayObject($data);
        $this->recordIterator = $object->getIterator();
        $iterator = $object->getIterator();
        $this->wrapper->setIterator($iterator);
        $rowsCount = count($iterator);
        
        $this->wrapper->openDocument();
            
        for ($i = 0; $i < $rowsCount; $i++) {
            $this->wrapper->aliasNbPages();
            if ($this->report->getPart('reportheader')->isDisplayed() === false) {
                $this->wrapper->writePDF($this->report->getPart('reportheader'), $this->report->getPart('reportheader')->getElements());
                $this->report->getPart('reportheader')->setIsDisplayed(true);
                $this->report->getPart('details')->setStartPosition($this->report->getPart('details')->getStartPosition() - $this->report->getPart('reportheader')->getHeight());
            }
            if (!is_null($this->report->getPart('details'))) {
                if ($this->report->getPart('details')->isVisible() === false) {
                    return false;
                }
            
                $return = $this->wrapper->writePDF($this->report->getPart('details'), $this->report->getPart('details')->getElements(), $iterator);
                
                if ($return === false) {
                    break;
                }
                $iterator->next();
                $this->recordIterator = $iterator;
            }
        }
        if ($this->report->getPart('reportfooter')->isDisplayed() === false) {
            $this->recordIterator->seek(0);
            $this->wrapper->writePDF($this->report->getPart('reportfooter'), $this->report->getPart('reportfooter')->getElements(), $this->recordIterator);
        }
        $this->wrapper->closeDocument();
        $this->wrapper->outputDocument();
    }
}