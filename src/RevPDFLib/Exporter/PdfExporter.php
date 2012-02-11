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

use RevPDFLib\Wrapper\TfpdfWrapper;
use RevPDFLib\Wrapper\TcpdfWrapper;

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

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
    protected $dic = null;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->dic = new DependencyInjection\ContainerBuilder();
        $this->dic->register('revpdflib.wrapper', 'RevPDFLib\Wrapper\TfpdfWrapper');
    }
    
    /**
     * Build document 
     * 
     * @param array $report Report
     * @param array $data   Data
     * 
     * @return boolean 
     */
    public function buildDocument(array $report, array $data)
    {
        $this->dic->register('revpdflib.report', 'RevPDFLib\Report')->addArgument($report);
        $this->dic->get('revpdflib.wrapper')->setReport($this->dic->get('revpdflib.report'));
        if (array_key_exists('pageHeader', $report)) {
            $this->dic->register('revpdflib.pageHeader', 'RevPDFLib\Items\Part\PageHeader')->addArgument($report['pageHeader']);
            $this->dic->get('revpdflib.pageHeader')->setIsVisible($report['pageHeader']['isVisible']);
            $this->dic->get('revpdflib.pageHeader')->setElements($report['pageHeader']['elements']);
            $this->dic->get('revpdflib.report')->addPart('pageHeader', $this->dic->get('revpdflib.pageHeader'));
        }
        if (array_key_exists('reportHeader', $report)) {
            $this->dic->register('revpdflib.reportHeader', 'RevPDFLib\Items\Part\ReportHeader')->addArgument($report['reportHeader']);
            $this->dic->get('revpdflib.reportHeader')->setIsVisible($report['reportHeader']['isVisible']);
            $this->dic->get('revpdflib.reportHeader')->setElements($report['reportHeader']['elements']);
            $this->dic->get('revpdflib.report')->addPart('reportHeader', $this->dic->get('revpdflib.reportHeader'));
        }
        if (array_key_exists('details', $report) && count($report['details']) > 0) {
            $this->dic->register('revpdflib.details', 'RevPDFLib\RevPDFLib\Items\Part\Details')->addArgument($report['details']);
            $this->dic->get('revpdflib.details')->setStartPosition(intval($this->dic->get('revpdflib.report')->getTopMargin()));
            $this->dic->get('revpdflib.details')->setElements($report['details']['elements']);
            $this->dic->get('revpdflib.report')->addPart('details', $this->dic->get('revpdflib.details'));
        }
        
        $this->dic->get('revpdflib.wrapper')->configure($this->dic->get('revpdflib.report')->getAllProperties());
        
        $this->dic->get('revpdflib.wrapper')->openDocument();
        
        $rowsCount = count($data);
        
        for ($i = 0; $i < $rowsCount; $i++) {
            if ($this->dic->get('revpdflib.reportHeader')->isDisplayed() === false) {
                $this->dic->get('revpdflib.wrapper')->writePDF($this->dic->get('revpdflib.reportHeader'), $this->dic->get('revpdflib.reportHeader')->getElements());
                $this->dic->get('revpdflib.reportHeader')->setIsDisplayed(true);
            }
            if (count($report['details']) > 0) {
                if ($report['details']['isVisible'] != 1) {
                    return false;
                }
            
                $return = $this->dic->get('revpdflib.wrapper')->writePDF($this->dic->get('revpdflib.details'), $this->dic->get('revpdflib.details')->getElements());

                if ($return === false) {
                    break;
                }
            }
        }
        $this->dic->get('revpdflib.wrapper')->closeDocument();
        $this->dic->get('revpdflib.wrapper')->outputDocument();
    }
}