<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../../');

require BASE_DIR . 'vendor/autoload.php';

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('helloworld.xml');
$lib->export($data);
