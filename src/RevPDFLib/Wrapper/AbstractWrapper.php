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

use RevPDFLib\Report;

/**
 * AbstractWrapper Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Wrapper
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
abstract class AbstractWrapper
{
    protected $currentPosition = 0;
    protected $endPosition = 0;
    protected $report = null;
    protected $writer = null;

    /**
     * Open Document
     * 
     * @return void
     */
    abstract function openDocument();
    
    /**
     * Close Document
     * 
     * @return void
     */
    abstract function closeDocument();
    
    
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
}