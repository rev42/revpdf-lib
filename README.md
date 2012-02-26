[RevPDFLib](http://www.revpdf.org)
==================================================

MANUAL
-------------------------------------
## Requirements
RevPDFLib requires *PHP 5.3.2* or later to work.
Your web server must allow executing PHAR archives.
In order to check whether you have this module or not, run the following command:
	# php -m | grep -i phar
If `Phar` is displayed, then the module is installed.  

it also requires some PHP libraries as per defined in composer.json

## How to install
Unzip archive and place it wherever you want on your server.
Download required PHP libraries by calling:
	# php composer.phar install
Then look at example folder to know how to call the library.

## How to render PDF
To generate PDF document, you need first to have xml output (see example folder).
Then you just have to call export method from RevPDFLib/Application class.

## What is Report
Reports are the virtual PDF documents. First you must define all its properties
and source data (database connection or files).
Each reports can contained parts. Those parts can contained elements.

- Fullname
  - report name
- Shortname
  - report shortname
- Author
  - report author
- Keywords
  - report keywords
- Subject
  - report subject
- Comments
  - report comment
- Margin
  - Defines all margins (top, left, bottom, right)
     (http://en.wikipedia.org/wiki/Margin_%28typography%29)
- Display Mode (Zoom)
  - Fullpage: displays the whole page
  - Fullwidth: displays the document with maximum width of window
  - Real: zoom at 100%
  - Default: uses default mode of viewer
- Display Mode (Layout)
  - Single: displays page per page
  - Continuous: displays pages continuously
  - Two: displays displays two pages on two columns
  - Default: uses default mode of viewer
- Paper Format
  - http://en.wikipedia.org/wiki/Paper_size
- Page Orientation
  - http://en.wikipedia.org/wiki/Page_orientation

## Source
- Provider
  - select source provider (PdoProvider, CsvProvider...)
- Value
  - Depending on source provider, it could be SQL query or path to file

## What is Part
Parts are contained in Reports. Parts are rendered in precise order (page header
 > Report Header > Data...). Some of them are only displayed once in document
(ie: report header/footer), some others are displayed on each page (page header/
footer), some others are displayed as long as they are data in rows (data).

- Part Type
  - could be either "Page Header", "Report Header", "Data",
    "Page Footer", "Report Footer"

- Part Height
  - height in mm

- Part Visible:
  - 1: elements will be displayed
  - 0: elements will not be displayed and part height will not be considered

- Part page jump:
  - 1: new page break will occur once the part has been displayed
  - 0: no page break after displaying the part

## What is Element
Elements are contained by Parts. There are different kind of elements: text,
Text Zone... Depending of its type, the behavior and the rendering will be
different.

 - Type:
   - textfield: simple text or text with some specific HTML tags
   - textzone: columns value. The value will be retrieved from source data
   - Image: stores image location
 - Format:
   - applies format to the text (full date, short date, number...)
 - Backcolor:
   - Color displayed inside element
 - Forecolor:
   - Element text color
 - Border:
   - Each side could be drawn/hidden (LRBT)
 - Border width:
   - Specify border width
 - Text alignment:
   - left, center, right
 - Position X:
   - Element position X (in mm)
 - Position Y:
   - Element position Y (in mm)
 - Element height:
   - Element height (in mm)
 - Element width:
   - Element width (in mm)
 - Element Z-index:
   - Element position Z (the higher the value is, the latest
      the element will be displayed)

## Font:
 - Fontname:
   - Choose font family. If you're going to use utf-8 characters, please note
     that you have to select an utf8 font family (like Deja Vu). Otherwise,
     your text will appear wrongly.
 - Size:
   - choose font size
 - Font style:
   - isBold:
     - 1: bold
     - 0: non-bold
   - isItalic:
     - 1: italic
     - 0: non-italic
   - isUnderline:
     - 1: underlined
     - 0: non-underlined