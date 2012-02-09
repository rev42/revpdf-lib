<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Reader\SimpleXMLReader;

class SimpleXMLReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $reader;
    
    public function setUp()
    {
        $this->reader = new SimpleXMLReader();
    }
    
    public function tearDown()
    {
        $this->reader = null;
    }
    
    public function testParseData()
    {
        $data = array(
            'report' => array(
                'author' => 'authorValue',
                'displayModeZoom' => 'displayModeZoomValue',
                'displayModeLayout' => 'displayModeLayoutValue',
                'keywords' => 'keywordsValue',
                'subject' => 'subjectValue',
                'title' => 'titleValue',
                'leftMargin' => '20',
                'topMargin' => '10',
                'rightMargin' => '5',
                'bottomMargin' => '15',
                'pageOrientation' => 'P'
            ),
        );
        
        $data = '
<?xml version="1.0" encoding="UTF-8"?>
<RevPDFLib
    shortname="short"
    fullname="full"
    author="moi"
    keywords="test, pdf, RevPDFLib"
    subject="un test"
    title="RevPDF test 1"
    comments="any comment"
    topMargin="10"
    bottomMargin="10"
    rightMargin="10"
    leftMargin="10"
    displayModeZoom="fullpage"
    displayModeLayout="continuous"
    pageOrientation="P"
    >
    <source provider="CsvProvider">
        <value>books.csv</value>
    </source>
    <pageHeader height="15" isVisible="1" backgroundColor="#FFF">
        <textField format="text" posX="0" posY="0" height="5" width="20">pageHeader textField1</textField>
        <textField format="text" posX="0" posY="5" height="5" width="20">pageHeader textField2</textField>
        <textZone format="text" posX="0" posY="10" height="5" width="20">pageHeader textZone</textZone>
    </pageHeader>
    <reportHeader height="20" isVisible="1" backgroundColor="#FFF">
        <textField format="text" posX="0" posY="0" height="5" width="20">reportHeader textField1</textField>
    </reportHeader>
</RevPDFLib>';
        
        $data = array(
            "report"=> array(
                "shortname" => "short",
                "fullname" => "full",
                "author" => "moi",
                "keywords"=> "test, pdf, RevPDFLib",
                "subject" => "un test",
                "title" => "RevPDF test 1",
                "comments" => "any comment",
                "topMargin" => "10",
                "bottomMargin" => "10",
                "rightMargin" => "10",
                "leftMargin" => "10",
                "displayModeZoom" => "fullpage",
                "displayModeLayout" => "continuous",
                "pageOrientation" => "P"
            ),
            "source" => array(
                "provider" => "CsvProvider",
                "value" => "books.csv" 
            ),
            "pageHeader" => array(
                "height" => "15",
                "isVisible" => "1",
                "backgroundColor" =>"#FFF",
                "elements" => array(
                    array(
                        "value" => "pageHeader textField1",
                        "type" => "textField",
                        "format" => "text",
                        "posX" => "0",
                        "posY" => "0",
                        "height" => "5",
                        "width" => "20"
                    ),
                    array(
                        "value" => "pageHeader textField2",
                        "type" => "textField",
                        "format" => "text",
                        "posX" => "0",
                        "posY" => "5",
                        "height" => "5",
                        "width" => "20",
                    ),
                    array(
                        "value" => "pageHeader textZone",
                        "type" => "textZone",
                        "format" => "text",
                        "posX" => "0",
                        "posY" => "10",
                        "height" => "5",
                        "width" => "20" 
                    )
                )
            ),
            "reportHeader" => array(
                "height" => "20",
                "isVisible" => "1",
                "backgroundColor" => "#FFF",
                "elements" => array(
                    array(
                        "value" => "reportHeader textField1",
                        "type" => "textField",
                        "format" => "text",
                        "posX" => "0",
                        "posY" => "0",
                        "height" => "5",
                        "width" => "20"
                    ),
                 ),
            ),
            "details" => array()
        );
        
        $this->assertSame($data, $this->reader->parseData($data));
    }
}