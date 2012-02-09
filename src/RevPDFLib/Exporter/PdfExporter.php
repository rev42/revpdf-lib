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
    private $sc = null;

    /**
     * Constructor
     * 
     * @param \RevPDFLib\Items\Part\AbstractPart $part Part
     * @param int $offset
     * 
     * @return void
     */
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('wrapper', 'RevPDFLib\Wrapper\TfpdfWrapper');
    }
    
    /**
     * Build document 
     * 
     * @param array $report Report
     * @param array $data Data
     * 
     * @return boolean 
     */
    public function buildDocument(array $report, array $data)
    {
        $this->sc->register('report', 'RevPDFLib\Report')->addArgument($report);
        $this->sc->get('wrapper')->setReport($this->sc->get('report'));
        if (array_key_exists('pageHeader', $report)) {
            $this->sc->register('pageHeader', 'RevPDFLib\Items\Part\PageHeader')->addArgument($report['pageHeader']);
            $this->sc->get('pageHeader')->setIsVisible($report['pageHeader']['isVisible']);
            $this->sc->get('pageHeader')->setElements($report['pageHeader']['elements']);
            $this->sc->get('report')->addPart('pageHeader', $this->sc->get('pageHeader'));
        }
        if (array_key_exists('reportHeader', $report)) {
            $this->sc->register('reportHeader', 'RevPDFLib\Items\Part\ReportHeader')->addArgument($report['reportHeader']);
            $this->sc->get('reportHeader')->setElements($report['reportHeader']['elements']);
            $this->sc->get('report')->addPart('reportHeader', $this->sc->get('reportHeader'));
        }
        if (array_key_exists('details', $report) && count($report['details']) > 0) {
            $this->sc->register('details', 'RevPDFLib\RevPDFLib\Items\Part\Details')->addArgument($report['details']);
            $this->sc->get('details')->setStartPosition(intval($this->sc->get('report')->getTopMargin()));
            $this->sc->get('details')->setElements($report['details']['elements']);
            $this->sc->get('report')->addPart('details', $this->sc->get('details'));
        }
        
        $this->sc->get('wrapper')->configure($this->sc->get('report')->getAllProperties());
        
        
        $this->sc->get('wrapper')->openDocument();
        
        $rowsCount = count($data);
        
        for ($i = 0; $i < $rowsCount; $i++) {
            if ($this->sc->get('reportHeader')->isDisplayed() === false) {
                $this->sc->get('wrapper')->writePDF($this->sc->get('reportHeader'), $this->sc->get('reportHeader')->getElements());
                $this->sc->get('reportHeader')->setIsDisplayed(true);
            }
            if (count($report['details']) > 0) {
                if ($report['details']['isVisible'] != 1) {
                    return false;
                }
            
                $return = $this->sc->get('wrapper')->writePDF($this->sc->get('details'), $this->sc->get('details')->getElements());

                if ($return === false) {
                    break;
                }
            }
        }
        $this->sc->get('wrapper')->closeDocument();
        $this->sc->get('wrapper')->outputDocument();
    }
}