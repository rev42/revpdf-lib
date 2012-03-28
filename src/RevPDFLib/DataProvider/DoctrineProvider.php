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
class DoctrineProvider implements DataProviderInterface
{
    protected $connector = null;
    
    /**
     * Get DB connection
     * 
     * @return object 
     */
    public function getConnector()
    {
        return $this->connector;
    }

    /**
     * Set DB Connection
     * 
     * @param type $conn DB connection
     * 
     * @return void
     */
    public function setConnector(\Doctrine_Connection $conn)
    {
        $this->connector = $conn;
    }

    /**
     * Execute SQL Query
     * 
     * @param string $sql SQL query
     * 
     * @see RevPDF_DataSource_Db_Interface::executeQuery()
     * 
     * @return array
     */
    public function executeQuery($sql)
    {
        $recordset = $this->prepareSQL($sql);
        $recordset->execute();

        return $recordset->fetchAll(\Doctrine::FETCH_ASSOC);
    }
    
    /**
     * Prepate SQL query
     * 
     * @param string $sql sql query
     * 
     * @return string
     */
    private function prepareSQL($sql)
    {
        return $this->connector->prepare($sql);
    }
    
    /**
     * Get Data
     * 
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set Data
     * 
     * @param array $data Data
     * 
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Parse data
     * 
     * @param string $sourceValue CSV filename
     * 
     * @return void 
     */
    public function parse($sourceValue)
    {
        if ($this->connector === null) {
            throw new \Exception('Connector is NOT set');
        }
        
        $rows = $this->executeQuery($sourceValue);
        
        $data = array();
        foreach ($rows as $row) {
            $data[] = $row;
        }
        $this->setData($data);
    }
}
