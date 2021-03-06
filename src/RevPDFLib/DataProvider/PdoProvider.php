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
class PdoProvider extends DataProviderAbstract implements DataProviderInterface
{
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

        return $recordset->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Prepate SQL query
     *
     * @param string $sql sql query
     *
     * @return string
     */
    protected function prepareSQL($sql)
    {
        return $this->connector->prepare($sql);
    }

    /**
     * Parse data
     * @param array $report Report data
     *
     * @throws \Exception
     */
    public function parse(array $report)
    {
        if ($this->connector === null) {
            throw new \Exception('Connector is NOT set');
        }

        $rows = $this->executeQuery($report['source']['value']);

        $data = array();
        foreach ($rows as $row) {
            $data[] = $row;
        }
        $this->setData($data);
    }
}
