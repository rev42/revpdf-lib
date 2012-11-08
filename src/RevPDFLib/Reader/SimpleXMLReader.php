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

namespace RevPDFLib\Reader;

/**
 * SimpleXMLReader Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Reader
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class SimpleXMLReader implements ReaderInterface
{
    /**
     * Parse data
     * 
     * @param array $data Data
     * 
     * @return array
     */
    public function parseData($data)
    {
        $formattedData = array();
        if ($data && $data->attributes()) {
            foreach ($data->attributes() as $key => $value) {
                $formattedData['report'][$key] = (string) $value;
            }
        }
        
        if ($data->source && $data->source->attributes()) {
            foreach ($data->source->attributes() as $key => $value) {
                $formattedData['source'][$key] = (string) $value;
            }
            foreach ($data->source->children() as $key => $elements) {
                $formattedData['source'][$key] = (string) $elements[0];
            }
        }

        $formattedData['pageHeader'] = $this->getPartData('pageheader', $data);
        $formattedData['reportHeader'] = $this->getPartData('reportheader', $data);
        $formattedData['details'] = $this->getPartData('details', $data);
        $formattedData['reportFooter'] = $this->getPartData('reportfooter', $data);
        $formattedData['pageFooter'] = $this->getPartData('pagefooter', $data);
        

        /*echo '<pre>';
        print_r($formattedData);
        echo '</pre>';exit;*/

        return $formattedData;
    }
    
    /**
     * Get Part data
     * 
     * @param array $node Node
     * @param array $data Data
     * 
     * @return array
     */
    protected function getPartData($node, $data)
    {
        $formattedData = array();
        
        if (isset($data->$node)) {
            if (count($data->$node->attributes()) > 0) {
                foreach ($data->$node->attributes() as $key => $value) {
                    $formattedData[$node][$key] = (string) $value;
                }
            }
            $formattedData[$node]['elements'] = array();
            foreach ($data->$node->children() as $key => $elements) {
                $element = array();
                $element['value'] = (string) trim($elements[0]);
                $element['type'] = $elements->getName();
                foreach ($elements->attributes() as $j => $value) {
                    $element[$j] = $this->getBool((string) $value);
                }
                foreach ($elements->children() as $key => $children) {
                    $element[$children->getName()] = array();
                    foreach ($children->attributes() as $k => $val) {
                        $element[$children->getName()][$k] = $this->getBool((string) $val);
                    }
                }
                $formattedData[$node]['elements'][] = $element;
            }

            return $formattedData[$node];
        } else {
            return array();
        }
    }
    
    /**
     * Retrieve boolean value from string 
     * 
     * @param string $value Value
     * 
     * @return boolean|null 
     */
    public function getBool($value) {
        switch (strtolower($value)) {
        case 'true': 
            return true;
            break;

        case 'false':
            return false;
            break;

        default: 
            return $value;
            break;
        }
    }

}
