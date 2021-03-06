<?php
namespace RevPDFLib\Tests;

use RevPDFLib\Reader\ArrayReader;

class ArrayReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $reader;

    public function setUp()
    {
        $this->reader = new ArrayReader();
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
            'pageheader' => array (),
            'reportheader' => array (),
            'details' => array (),
            'reportfooter' => array (),
            'pagefooter' => array (),
        );

        $this->assertSame($data, $this->reader->parseData($data));
    }

    public function testParseEmptyData()
    {
        $inputData = array();

        $outputData = array(
            'pageheader' => array(),
            'reportheader' => array(),
            'details' => array(),
            'reportfooter' => array(),
            'pagefooter' => array(),
        );

        $this->assertSame($outputData, $this->reader->parseData($inputData));
    }
}
