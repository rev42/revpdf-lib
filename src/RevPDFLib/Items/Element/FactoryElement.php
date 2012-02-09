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
 * Element Factory Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class FactoryElement
{
    
    /**
     * Element factory
     *
     * @param string $type type of Element to generate
     *
     * @return object
     */
    public static function getFactory($type)
    {
        switch ($type) {
            case 'textZone':
                return new Textzone();
                break;
            case 'PageNumber':
                return new Pagenumber();
                break;
            case 'textField':
                return new Textfield();
                break;
            case 'Image':
                return new Image();
                break;
            case 'RoundedBox':
                return new Roundedbox();
                break;
            case 'Rectangle':
                return new Rectangle();
                break;
            case 'Line':
                return new Line();
                break;
            default:
                throw new \Exception('This element type is not supported : ' . $type);
                break;
        }
    }
}

?>
