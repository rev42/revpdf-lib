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

namespace RevPDFLib\Items\Element;

/**
 * Textzone Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class Textzone extends AbstractElement
{
    /**
     * Set Textzone Value 
     * 
     * @param array $iterator Record iterator
     * 
     * @return void
     */
    public function getField($iterator=null)
    {
        $field = '';
        $elementField = $this->field;
        
        if (!is_null($iterator)) {
            $recordRows = $iterator->current();
            if (is_array($recordRows) === false) {
                $recordRows = (array) $recordRows;
            }
            if (in_array($elementField, array_keys($recordRows))) {
                $field = $recordRows[$elementField];
            }
        }

        return $this->format($field);
    }
}