<?php

namespace RevPDFLib\Tests;

use RevPDFLib\DataProvider\PdoProvider;

/**
 * Test class for PdoProvider.
 * Generated by PHPUnit on 2012-03-29 at 08:49:47.
 */
class PdoProviderTest extends \PHPUnit_Extensions_Database_TestCase
{
    protected $connection;
    protected $datasetFolder;

    /**
     * @var PdoProvider
     */
    protected $object;

    protected function getConnection()
    {
        return $this->createDefaultDBConnection($this->connection, 'mysql');
    }

    protected function getDataSet()
    {
        //return $this->createFlatXMLDataset($this->datasetFolder . 'report-seed.xml');
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $params = array(
            'dbms' => 'pdo',
            'dbhost' => DBHOST,
            'dbport' => DBPORT,
            'dbname' => DBNAME,
            'dbuser' => DBUSER,
            'dbpasswd' => DBPASSWD
        );
        $this->db = new \DbConnection($params);
        $this->connection = $this->db->getConnection();

        $this->object = new PdoProvider;
        $this->object->setConnector($this->connection);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers RevPDFLib\DataProvider\PdoProvider::getConnector
     */
    public function testGetConnector()
    {
        $this->object->setConnector($this->connection);
        $this->assertTrue($this->object->getConnector() instanceof \PDO);
    }

    /**
     * @covers RevPDFLib\DataProvider\PdoProvider::setConnector
     */
    public function testSetConnector()
    {
        $this->object->setConnector($this->connection);
        $this->assertTrue($this->object->getConnector() instanceof \PDO);
    }

    /**
     * @covers RevPDFLib\DataProvider\PdoProvider::executeQuery
     */
    public function testExecuteQuery()
    {
        $rows = $this->object->executeQuery('(select 1) union (select 2) union (select 3) union (select 4) union (select 5)');
        $this->assertCount(5, $rows);
    }

    /**
     * @covers RevPDFLib\DataProvider\PdoProvider::setData
     * @todo Implement testSetData().
     */
    public function testSetData()
    {
        $data = array(1, 2, 3);
        $this->object->setData($data);
        $this->assertCount(3, $this->object->getData());
    }

    /**
     * @covers RevPDFLib\DataProvider\PdoProvider::parse
     * @covers RevPDFLib\DataProvider\PdoProvider::getData
     */
    public function testParse()
    {
        $report = array();
        $report['source']['value'] = '(select 1) union (select 2) union (select 3) union (select 4) union (select 5)';
        $this->object->parse($report);
        $this->assertCount(5, $this->object->getData());
    }

}
