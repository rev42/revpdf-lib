<?php
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') || define('BASE_DIR', dirname(__file__) . '/../../');

require BASE_DIR . 'vendor/autoload.php';

$conn = new PDO('mysql:dbname=revpdf;host=localhost', 'revpdf', 'password');
$conn->exec("SET CHARACTER SET utf8");

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('inventory.xml');
$lib->setDatasource($conn);
$lib->export($data);
