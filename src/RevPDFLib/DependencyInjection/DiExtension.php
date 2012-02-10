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

namespace RevPDFLib\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * DiExtension Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage DependencyInjection
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class DiExtension
{
    protected $servicePath = null;
    protected $container = null;
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        // Loads all services
        $this->servicePath = realpath(__DIR__.'/config/');
        
        $this->container = new ContainerBuilder();
        $loader = new XmlFileLoader($this->container, new FileLocator($this->servicePath));
        $loader->load('services.xml');
    }
    
    /**
     * Get Container
     * 
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder 
     */
    public function getContainer()
    {
        return $this->container;
    }
}