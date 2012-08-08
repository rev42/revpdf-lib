<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../../');

require BASE_DIR . 'vendor/autoload.php';

$conn = new PDO('mysql:dbname=revpdf;host=localhost', 'revpdf', 'password');
$conn->exec("SET CHARACTER SET utf8");

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('invoice.xml');
$lib->setDatasource($conn);
$lib->export($data);