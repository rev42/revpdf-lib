<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('BASE_DIR') or define('BASE_DIR', dirname(__file__) . '/../');

require BASE_DIR . 'vendor/.composer/autoload.php';

$lib = new RevPDFLib\Core();
$lib->setDataSourceType('array');

$data = array(
    'report' => array(
        'attributes' => array(
            'short_name' => 'mon rapport',
            'full_name' => 'mon rapport en version longue',
            'author' => 'auteur moi',
            'keywords' => 'test, pdf',
            'subject' => 'mon sujet',
            'title' => 'mon titre',
            'display_mode_zoom' => 'fullpage',
            'display_mode_layout' => 'continuous',
            'comments' => 'mes commentaires',
            'source_type' => 'DB',
            'source_location' => '',
            'source_value' => 'select * from _r_article order by id',
            'output_filename' => 'liste.pdf',
            'output_file_destination' => 'I',
            'paper_format' => 'A4',
            'page_orientation' => 'P',
            'top_margin' => '10',
            'bottom_margin' => '10',
            'right_margin' => '10',
            'left_margin' => '10',
        ),
        'parts' => array(
            'page_header' => array(
                'attributes' => array(
                    'number' => '1',
                    'height' => '7',
                    'is_visible' => '1',
                    'background_color' => '#FFF',
                ),
                'elements' => array(
                    array(
                        'type' => 'textfield',
                        'field' => 'Un texte',
                        'format' => 'text'
                    ),
                    array(
                        'type' => 'textfield',
                        'field' => 'Un autre texte',
                        'format' => 'text'
                    ),
                )
            ),
            'page_footer' => array(
                'attributes' => array(
                    'number' => '2',
                    'height' => '14',
                    'is_visible' => '1',
                    'background_color' => '#FFF',
                ),
                'elements' => array(
                    array(
                        'type' => 'textfield',
                        'field' => 'Un texte dans la part 2',
                        'format' => 'text'
                    ),
                    array(
                        'type' => 'textfield',
                        'field' => 'Un autre texte dans la part 2',
                        'format' => 'text'
                    ),
                )
            ),
        )
    ),
);

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