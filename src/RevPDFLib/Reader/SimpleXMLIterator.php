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

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * SimpleXMLIterator Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Reader
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class SimpleXMLIterator implements ReaderInterface {

    /**
     * Parse data
     * 
     * @param array $data Data
     * 
     * @return array
     */
    public function parseData($data) {
        $formattedData = array();
        $formattedData = $this->sxiToArray($data);

        echo '<pre>';
        print_r($formattedData);
        echo '</pre>';
        exit;

        return $formattedData;
    }

    function sxiToArray($sxi) 
    {
        $a = array();
        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {
            if(!array_key_exists($sxi->key(), $a)){
            $a[$sxi->key()] = array();
            }
            if($sxi->hasChildren()){
            $a[$sxi->key()][] = $this->sxiToArray($sxi->current());
            }
            else{
            $a[$sxi->key()][] = strval($sxi->current());
            }
        }
        return $a;
    }

    /**
     * Get Part data
     * 
     * @param array $node Node
     * @param array $data Data
     * 
     * @return array
     */
    protected function getPartData($node, $data) {
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
