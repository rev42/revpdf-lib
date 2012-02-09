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

/**
 * TcpdfWrapper Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Wrapper
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class TcpdfWrapper extends AbstractWrapper implements WrapperInterface
{
    public function __construct($pageOrientation = 'P', $paperUnit = 'mm', $paperFormat = 'A4')
    {
        $this->writer = new \TCPDF($pageOrientation, $paperUnit, $paperFormat, true, 'UTF-8', false);
    }
    
    public function configure($report)
    {
        //$this->writer->setEndPosition($report['bottomMargin']);
        //$this->writer->setCurrentPosition($report['topMargin']);
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
        
        $this->writer->setPrintHeader(false);
        $this->writer->setPrintFooter(false);
        
        $this->writer->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        //set auto page breaks
        $this->writer->SetAutoPageBreak(TRUE, $report['bottomMargin']);

        //set image scale factor
        $this->writer->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $this->writer->SetFont('times', 'BI', 20);
    }
    
    public function output()
    {
        $this->writer->Output();
    }
    
    public function write($value)
    {
        $this->writer->writeHTMLCell($w=0, $h=0, $x='', $y='', $value, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
    }
    
    public function openDocument()
    {
        $this->writer->AddPage();
    }
    
    public function closeDocument()
    {
        
    }
}