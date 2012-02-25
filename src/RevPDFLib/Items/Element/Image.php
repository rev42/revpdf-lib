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
 * Image Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class Image extends AbstractElement
{
    /**
     * Write content into instance of PDF class
     * 
     * @param object &$writer  instance of PDF writer
     * @param object $iterator Data iterator
     * 
     * @see RevPDF_Element_Abstract::writeContent()
     * 
     * @return void
     */
    public function writeContent(&$writer, $iterator)
    {
        if (is_file($this->getField($writer, $iterator)) !== false) {
            $writer->Image(
                $this->getField($writer, $iterator), 
                $writer->GetX(), 
                $writer->GetY(), 
                $this->getWidth(),
                $this->getHeight()
            );
        }
    }    
}