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

namespace RevPDFLib;

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

/**
 * RevPDFLib application
 * 
 * @author Olivier Cornu <contact@revpdf.org>
 */
class Application
{
    const NAME = 'RevPDFLib';
    const VERSION = '2.0.0 (20120129)';
    
    private $sc = null;
    
    public function __construct()
    {
        $this->sc = new DependencyInjection\ContainerBuilder();
        $this->sc->register('exporter', 'RevPDFLib\Exporter\PdfExporter');
    }
    
    protected function selectDataProvider($value)
    {
        $this->sc->register('provider', 'RevPDFLib\DataProvider\\' . $value);
    }
    
    public function export($data)
    {
        switch (gettype($data)) {
            case 'array':
                $this->sc->register('reader', 'RevPDFLib\Reader\ArrayReader');
                break;
            case 'object':
                if (get_class($data) == 'SimpleXMLElement') {
                    $this->sc->register('reader', 'RevPDFLib\Reader\SimpleXMLReader');
                }
                break;
            default:
                throw new Exception();
        }
        // Get data properly formatted
        $report = $this->sc->get('reader')->parseData($data);
        
        // Get data provider
        $this->selectDataProvider($report['source']['provider']);
        $this->sc->get('provider')->parse($report['source']['value']);
        $data = $this->sc->get('provider')->data;
        
        // Build document and generate it
        $document = null;
        if (is_array($report)) {
            $document = $this->sc->get('exporter')->buildDocument($report, $data);
        }
        return $document;
    }
}