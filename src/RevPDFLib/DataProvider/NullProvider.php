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

namespace RevPDFLib\DataProvider;

/**
 * Pdo Provider
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage DataProvider
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class NullProvider extends DataProviderAbstract implements DataProviderInterface
{
    /**
     * Parse data
     * 
     * @param array $report Report data
     * 
     * @return void 
     */
    public function parse($report)
    {
        if ($this->connector === null) {
            throw new \Exception('Connector is NOT set');
        }
        
        $data = array();
        $parts = \RevPDFLib\Application::getSupportedParts();
        
        foreach ($parts as $part) {
            if (array_key_exists($part, $report)) {
                if (isset($report[$part]['elements'])) {
                    foreach ($report[$part]['elements'] as $element) {
                        if ($element['type'] == 'textzone') {
                            $data[$element['value']] = $element['value'];
                        }
                    }
                }
            }
        }
        $this->setData(array($data));
    }
}