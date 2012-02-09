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

class SimpleXMLReader implements ReaderInterface
{
    public function parseData($data)
    {
        $formattedData = array();
        foreach ($data->attributes() as $key => $value) {
            $formattedData['report'][$key] = (string) $value;
        }
        
        foreach ($data->source->attributes() as $key => $value) {
            $formattedData['source'][$key] = (string) $value;
        }
        foreach ($data->source->children() as $key => $elements) {
            $formattedData['source'][$key] = (string) $elements[0];
        }
        
        $formattedData['pageHeader'] = $this->getPartData('pageHeader', $data);
        $formattedData['reportHeader'] = $this->getPartData('reportHeader', $data);
        $formattedData['details'] = $this->getPartData('details', $data);
        
       /*
        echo '<pre>';
        print_r($formattedData);
        echo '</pre>';exit;
        */
        return $formattedData;
    }
    
    protected function getPartData($node, $data)
    {
        $formattedData = array();
        
        if (isset($data->$node) && count($data->$node->attributes()) > 0) {
            foreach ($data->$node->attributes() as $key => $value) {
                $formattedData[$node][$key] = (string) $value;
            }
            $formattedData[$node]['elements'] = array();
            foreach ($data->$node->children() as $key => $elements) {
                $element['value'] = (string) $elements[0];
                $element['type'] = $elements->getName();
                foreach ($elements->attributes() as $j => $value) {
                    $element[$j] = (string) $value;
                }
                $formattedData[$node]['elements'][] = $element;
            }
            
            return $formattedData[$node];
        } else {
            return array();
        }
    }
}
