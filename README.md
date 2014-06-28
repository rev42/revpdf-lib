[RevPDFLib](http://www.revpdf.org) [![Build Status](https://secure.travis-ci.org/rev42/revpdf-lib.png?branch=master)](http://travis-ci.org/rev42/revpdf-lib)
==================================================
RevPDFLib provides the building block to create PDF file for [RevPDF][] web application.

RevPDFLib parses an XML file (build manually or using [RevPDF][]) 
and generates PDF file. This library can be used as a standalone application.

``RevPDFLib`` takes a XML file as an input and output a PDF file.

"Hello World" example:

    <?xml version="1.0" encoding="UTF-8"?>
    <RevPDFLib>
        <font name="courier" size="16" textColor="#3366FF" style="B" />
        <details height="20" isVisible="1" backgroundColor="#FFF">
            <textfield format="text" x="0" y="0" height="10" width="40" border="1" forecolor="#3366FF" backcolor="#FFFF00" zindex="0">
                <font isUnderline="false" isBold="true" isItalic="true" fontName="courier" size="14" />
                <![CDATA[Hello World!]]>
            </textfield>
        </details>
    </RevPDFLib>

Calling RevPDFLib is really easy:

    defined('BASE_DIR') || define('BASE_DIR', dirname(__file__) . '/../');
    require BASE_DIR . 'vendor/autoload.php';
    
    $lib = new RevPDFLib\Application();
    $data = simplexml_load_file('helloworld.xml');
    $lib->export($data);

Please read the MANUAL for further explanations (how to install, how to create a compatible xml file...)

[RevPDF]: http://www.revpdf.org