<?php
class DbConnection
{
    protected $connection = null;

    public function __construct($params=array())
    {
        switch($params['dbms']) {
            case 'doctrine':
                require_once __DIR__.'/vendor/doctrine/Doctrine.php';
                spl_autoload_register(array('Doctrine', 'autoload'));
                $connectionString = sprintf('mysql://%s:%s@%s/%s',
                        $params['dbuser'],
                        $params['dbpasswd'],
                        $params['dbhost'],
                        $params['dbname']
                );
                $this->connection = \Doctrine_Manager::connection($connectionString);
                $this->connection->setAttribute(\Doctrine::ATTR_QUOTE_IDENTIFIER, true);
                $this->connection->setCharset('utf8');
                break;

            case 'pdo':
                $connectionString = sprintf('mysql:dbname=%s;host=%s',
                        $params['dbname'],
                        $params['dbhost']
                );
                $this->connection = new \PDO($connectionString, $params['dbuser'], $params['dbpasswd']);
                break;

            default:
                throw new \BadMethodCallException();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
