<?php

namespace RevPDFLib\Tests;

use RevPDFLib\DataProvider\DoctrineProvider;

/**
 * Test class for DoctrineProvider.
 * Generated by PHPUnit on 2012-03-29 at 23:30:48.
 */
class DoctrineProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $connection;
    protected $datasetFolder;
    
    /**
     * @var DoctrineProvider
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
        $this->db = new \DbConnection('doctrine');
        $this->connection = $this->db->getConnection();
        
        $this->object = new DoctrineProvider;
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
     * @covers RevPDFLib\DataProvider\DoctrineProvider::setConnector
     * @todo Implement testSetConnector().
     */
    public function testSetConnector()
    {
        $this->object->setConnector($this->connection);
        $this->assertTrue($this->object->getConnector() instanceof \Doctrine_Connection);
    }

    /**
     * @covers RevPDFLib\DataProvider\DoctrineProvider::executeQuery
     * @todo Implement testExecuteQuery().
     */
    public function testExecuteQuery()
    {
        $rows = $this->object->executeQuery('(select 1) union (select 2) union (select 3) union (select 4) union (select 5)');
        $this->assertCount(5, $rows);
    }

}

?>