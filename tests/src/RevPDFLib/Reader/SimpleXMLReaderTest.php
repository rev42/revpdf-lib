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
        $data = '<?xml version="1.0" encoding="UTF-8"?>
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
    pageLayout="A4"
    >
    <source provider="CsvProvider">
        <value>books.csv</value>
    </source>
    <pageHeader height="15" isVisible="1" backgroundColor="#FFF">
        <textfield format="text" x="0" y="0" height="5" width="20">pageHeader textfield1</textfield>
        <textfield format="text" x="0" y="5" height="5" width="20">pageHeader textfield2</textfield>
        <textzone format="text" x="0" y="10" height="5" width="20">pageHeader textzone</textzone>
    </pageHeader>
    <reportHeader height="20" isVisible="1" backgroundColor="#FFF">
        <textfield format="text" x="0" y="0" height="5" width="20">reportHeader textfield1</textfield>
    </reportHeader>
    <pageFooter height="10" isVisible="1" backgroundColor="#F00">
        <textfield format="text" x="10" y="0" height="5" width="40" border="1">
            Footer
        </textfield>
    </pageFooter>
</RevPDFLib>';
        
        $expected = array(
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
                "pageOrientation" => "P",
                "pageLayout" => "A4"
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
                        "value" => "pageHeader textfield1",
                        "type" => "textfield",
                        "format" => "text",
                        "x" => "0",
                        "y" => "0",
                        "height" => "5",
                        "width" => "20"
                    ),
                    array(
                        "value" => "pageHeader textfield2",
                        "type" => "textfield",
                        "format" => "text",
                        "x" => "0",
                        "y" => "5",
                        "height" => "5",
                        "width" => "20",
                    ),
                    array(
                        "value" => "pageHeader textzone",
                        "type" => "textzone",
                        "format" => "text",
                        "x" => "0",
                        "y" => "10",
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
                        "value" => "reportHeader textfield1",
                        "type" => "textfield",
                        "format" => "text",
                        "x" => "0",
                        "y" => "0",
                        "height" => "5",
                        "width" => "20"
                    ),
                 ),
            ),
            "details" => array(),
            "reportFooter" => array(),
            "pageFooter" => array(
                "height" => "10",
                "isVisible" => "1",
                "backgroundColor" =>"#F00",
                "elements" => array(
                    array(
                        "value" => "Footer",
                        "type" => "textfield",
                        "format" => "text",
                        "x" => "10",
                        "y" => "0",
                        "height" => "5",
                        "width" => "40",
                        "border" => "1"
                    ),
                ),
            )
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_string($data)));
    }
}