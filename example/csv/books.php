<?php
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') || define('BASE_DIR', dirname(__file__) . '/../../');

require BASE_DIR . 'vendor/autoload.php';

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('books.xml');
$lib->export($data);
