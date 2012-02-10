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
use RevPDFLib\DependencyInjection\DiExtension;

/**
 * Application Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Application
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class Application
{
    /**
     * Application Name 
     */
    const NAME = 'RevPDFLib';
    
    /**
     * Application Version
     */
    const VERSION = '2.0.0 (20120129)';
    
    /**
     * Store all dependencies
     * 
     * @var object Dependency Injection Container
     */
    protected $dic = null;
    
    /**
     * Application Constructor 
     * 
     * @return void
     */
    public function __construct()
    {
        $dependency = new DiExtension();
        
        try {
            $this->setDic($dependency->getContainer());
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        $this->dispatcher = $this->getDic()->get('revpdflib.event_dispatcher');
    }
    
    /**
     * Get Container
     * 
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    public function getDic()
    {
        return $this->dic;
    }
    
    /**
     * Set Container
     * 
     * @param string \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    public function setDic(\Symfony\Component\DependencyInjection\ContainerBuilder $value)
    {
        $this->dic = $value;
    }
    
    /**
     * Register data provider into dic
     * 
     * @param string $value Data Provider name
     * 
     * @return void
     */
    protected function selectDataProvider($value)
    {
        $this->dic->register('revpdflib.provider', 'RevPDFLib\DataProvider\\' . $value);
    }
    
    /**
     * Export data into PDF
     * 
     * @param array $data
     * 
     * @return array
     * 
     * @throws Exception 
     */
    public function export($data)
    {
        switch (gettype($data)) {
        case 'array':
            $this->getDic()->register('revpdflib.reader', 'RevPDFLib\Reader\ArrayReader');
            break;
        case 'object':
            if (get_class($data) == 'SimpleXMLElement') {
                $this->getDic()->register('revpdflib.reader', 'RevPDFLib\Reader\SimpleXMLReader');
            }
            break;
        default:
            throw new Exception();
        }
        // Get data properly formatted
        $report = $this->getDic()->get('revpdflib.reader')->parseData($data);
        if (!is_array($report)) {
            return null;
        }
        
        // Get data provider and parse data
        $this->selectDataProvider($report['source']['provider']);
        $this->getDic()->get('revpdflib.provider')->parse($report['source']['value']);
        $data = $this->getDic()->get('revpdflib.provider')->data;
        
        // Build document and generate it
        $document = $this->getDic()->get('revpdflib.exporter')->buildDocument($report, $data);

        return $document;
    }
}