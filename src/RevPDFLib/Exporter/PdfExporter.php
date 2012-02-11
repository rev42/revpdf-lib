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
        $this->dic->register('wrapper', 'RevPDFLib\Wrapper\TfpdfWrapper');
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
        $this->dic->register('report', 'RevPDFLib\Report')->addArgument($report);
        $this->dic->get('wrapper')->setReport($this->dic->get('report'));
        if (array_key_exists('pageHeader', $report)) {
            $this->dic->register('pageHeader', 'RevPDFLib\Items\Part\PageHeader')->addArgument($report['pageHeader']);
            $this->dic->get('pageHeader')->setIsVisible($report['pageHeader']['isVisible']);
            $this->dic->get('pageHeader')->setElements($report['pageHeader']['elements']);
            $this->dic->get('report')->addPart('pageHeader', $this->dic->get('pageHeader'));
        }
        if (array_key_exists('reportHeader', $report)) {
            $this->dic->register('reportHeader', 'RevPDFLib\Items\Part\ReportHeader')->addArgument($report['reportHeader']);
            $this->dic->get('reportHeader')->setIsVisible($report['reportHeader']['isVisible']);
            $this->dic->get('reportHeader')->setElements($report['reportHeader']['elements']);
            $this->dic->get('report')->addPart('reportHeader', $this->dic->get('reportHeader'));
        }
        if (array_key_exists('details', $report) && count($report['details']) > 0) {
            $this->dic->register('details', 'RevPDFLib\RevPDFLib\Items\Part\Details')->addArgument($report['details']);
            $this->dic->get('details')->setStartPosition(intval($this->dic->get('report')->getTopMargin()));
            $this->dic->get('details')->setElements($report['details']['elements']);
            $this->dic->get('report')->addPart('details', $this->dic->get('details'));
        }
        
        $this->dic->get('wrapper')->configure($this->dic->get('report')->getAllProperties());
        
        $this->dic->get('wrapper')->openDocument();
        
        $rowsCount = count($data);
        
        for ($i = 0; $i < $rowsCount; $i++) {
            if ($this->dic->get('reportHeader')->isDisplayed() === false) {
                $this->dic->get('wrapper')->writePDF($this->dic->get('reportHeader'), $this->dic->get('reportHeader')->getElements());
                $this->dic->get('reportHeader')->setIsDisplayed(true);
            }
            if (count($report['details']) > 0) {
                if ($report['details']['isVisible'] != 1) {
                    return false;
                }
            
                $return = $this->dic->get('wrapper')->writePDF($this->dic->get('details'), $this->dic->get('details')->getElements());

                if ($return === false) {
                    break;
                }
            }
        }
        $this->dic->get('wrapper')->closeDocument();
        $this->dic->get('wrapper')->outputDocument();
    }
}