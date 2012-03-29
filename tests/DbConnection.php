<?php
class DbConnection
{
    protected $connection = null;
    
    public function __construct($type)
    {
        switch($type) {
            case 'doctrine':
                require_once __DIR__.'/vendor/doctrine/Doctrine.php';
                spl_autoload_register(array('Doctrine', 'autoload'));
                $this->connection = \Doctrine_Manager::connection('mysql://root:password@ubuntu-server/revpdf');
                $this->connection->setAttribute(\Doctrine::ATTR_QUOTE_IDENTIFIER, true);
                $this->connection->setCharset('utf8');
                break;
            
            case 'pdo':
                $this->connection = new \PDO('mysql:dbname=revpdf;host=ubuntu-server', 'root', 'password');
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