<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../');

require BASE_DIR . 'vendor/.composer/autoload.php';

$conn = new PDO('mysql:dbname=revpdf;host=ubuntu-server', 'root', 'password');
$conn->exec("SET CHARACTER SET utf8");

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('inventory.xml');
$lib->setDatasource($conn);
$lib->export($data);