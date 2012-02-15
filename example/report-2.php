<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../');

require BASE_DIR . 'vendor/.composer/autoload.php';


$conn = new PDO('mysql:dbname=revpdf;host=ubuntu-server', 'root', 'password');
$conn->exec("SET CHARACTER SET utf8");

/*
$recordset = $conn->prepare('select * from _r_article');
$recordset->execute();
var_dump($recordset->fetchAll(PDO::FETCH_ASSOC));
exit;*/

$lib = new RevPDFLib\Application();
$data = simplexml_load_file('report-2.xml');
$lib->setDatasource($conn);
$lib->export($data);

/*
// 1. include RevPDF class and mandatory classes (PDF libraries) 
require_once (BASE_DIR . 'src/RevPDFLib/Core.php');
require_once (BASE_DIR . 'projets/revpdf_gui/library/tfpdf/tfpdf.php');
require_once (BASE_DIR . 'projets/revpdf_gui/library/qrcode/qrcode.class.php');

// 2. set autoload function of RevPDF class
spl_autoload_register(array('RevPDF', 'autoload'));

// 3. select datasource (create it if it doesn't exist)
$factory = RevPDF_DataSource_Factory::getFactory('db'); // db connection
// 4. select DB library
$connector = $factory->getClass('pdo'); // we'll use RevPDF_DataSource_Db_Pdo class
$connector->setDsn(array('storage' => 'mysql',
                         'hostname' => '127.0.0.1',
                         'database_name' => 'revpdf'));
$connector->connect(array(
    'username' => 'root',
    'password' => 'password',
));
            
RevPDF::setConnector($connector);

// 4. create specific classes for RevPDF
class Report
{
    public static function getReportById($id) {
        $results = array();
        $query = sprintf("select * from _r_report where id=%d", (int) $id);
        $report = RevPDF::getConnector()->executeQuery($query);
        $report = $report[0];
        
        $query = sprintf("select * from _r_part where report_id=%d", (int) $id);
        $report->Parts = RevPDF::getConnector()->executeQuery($query);
        foreach($report->Parts as $i => $part) {
            $query = sprintf("select * from _r_element where part_id=%d", (int) $part->id);
            $report->Parts[$i]->Elements = RevPDF::getConnector()->executeQuery($query);
        }
        
        return $report;
    }   
}

class ApplicationSettingTable
{
    public static function getSetting($setting) {
        $results = array();
        $query = sprintf("select * from _r_applicationsettings where code='%s'", (string) $setting);
        $stmt = RevPDF::getConnector()->executeQuery($query);

        return $stmt[0]->value;
    }
}

// 5. Call PDF renderer with Report id as parameter 1 
try{
    $result = RevPDF_Core::export(1);
    echo $result->getStatusMessage();
} catch(Exception $e) {
    echo $e->getMessage();
}*/