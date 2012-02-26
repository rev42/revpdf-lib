<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Reader\SimpleXMLReader;

class SimpleXMLReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $reader;
    protected $examplesFolder;
    
    public function setUp()
    {
        $this->reader = new SimpleXMLReader();
        $this->examplesFolder =  __DIR__ . '/../../../example/xml/';
    }
    
    public function tearDown()
    {
        $this->reader = null;
    }
    
    public function testParseData1()
    {
        $file = $this->examplesFolder . '1.xml';
        
        $expected = array(
            "report"=> array(
                "shortname" => "books",
                "fullname" => "Books review",
                "author" => "me",
                "keywords"=> "books, review, RevPDFLib",
                "subject" => "review of my books",
                "title" => "Books review",
                "comments" => "some review",
                "topMargin" => "5",
                "bottomMargin" => "10",
                "rightMargin" => "15",
                "leftMargin" => "20",
                "displayModeZoom" => "fullpage",
                "displayModeLayout" => "continuous",
                "pageOrientation" => "L",
                "paperFormat" => "A4"
            ),
            'pageHeader' => array(),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData2()
    {
        $file = $this->examplesFolder . '2.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'source' => array(
                'provider' => 'PdoProvider',
                'value' => 'Select * from _r_article'
            ),
            'pageHeader' => array(),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData3()
    {
        $file = $this->examplesFolder . '3.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData4()
    {
        $file = $this->examplesFolder . '4.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(
                'height' => '20',
                'isVisible' => '1',
                'backgroundColor' => '#F00',
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData5()
    {
        $file = $this->examplesFolder . '5.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(),
            'reportHeader' => array(),
            'details' => array(
                'height' => '20',
                'isVisible' => '1',
                'backgroundColor' => '#F00',
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData6()
    {
        $file = $this->examplesFolder . '6.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(),
            'reportHeader' => array(
                'height' => '20',
                'isVisible' => '1',
                'backgroundColor' => '#F00',
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData7()
    {
        $file = $this->examplesFolder . '7.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(
                'height' => '20',
                'isVisible' => '1',
                'backgroundColor' => '#F00',
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
            'pageFooter' => array(),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    public function testParseData8()
    {
        $file = $this->examplesFolder . '8.xml';
        
        $expected = array(
            'report'=> array(
                'shortname' => 'books',
                'fullname' => 'Books review',
                'author' => 'me',
                'keywords'=> 'books, review, RevPDFLib',
                'subject' => 'review of my books',
                'title' => 'Books review',
                'comments' => 'some review',
                'topMargin' => '5',
                'bottomMargin' => '10',
                'rightMargin' => '15',
                'leftMargin' => '20',
                'displayModeZoom' => 'fullpage',
                'displayModeLayout' => 'continuous',
                'pageOrientation' => 'L',
                'paperFormat' => 'A4'
            ),
            'pageHeader' => array(),
            'reportHeader' => array(),
            'details' => array(),
            'reportFooter' => array(),
            'pageFooter' => array(
                'height' => '20',
                'isVisible' => '1',
                'backgroundColor' => '#F00',
                'elements' => array(
                    0 => array(
                        'value' => 'MOVIES',
                        'type' => 'textfield',
                        'format' => 'text',
                        'x' => '80',
                        'y' => '5',
                        'height' => '5',
                        'width' => '42',
                        'border' => '1'
                    )
                )
            ),
        );
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
    
    
    public function testParseData()
    {
        $file = $this->examplesFolder . 'data.xml';
        
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
                "paperFormat" => "A4"
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
        
        $this->assertSame($expected, $this->reader->parseData(simplexml_load_file($file)));
    }
}