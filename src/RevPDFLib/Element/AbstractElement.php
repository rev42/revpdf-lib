<?php
namespace RevPDFLib\Element;

use RevPDFLib\Element\Textfield;

abstract class AbstractElement
{
    /**
     * Position x
     *
     * @var int $_posx
     */
    protected $posx;
    /**
     * Position y
     *
     * @var int $_posy
     */
    protected $posy;
    /**
     * font name
     *
     * @var string $_font
     */
    protected $font;
    /**
     * Should element be extended if content is overlapping
     *
     * @var boolean $_isAutoExtend
     */
    protected $isAutoExtend;
    /**
     * Font style (Underline, Italic, Bold, Normal)
     *
     * @var string $_style
     */
    protected $style;
    /**
     * Font size
     *
     * @var in $_fontSize
     */
    protected $fontSize;
    /**
     * Width
     *
     * @var int $_width
     */
    protected $width;
    /**
     * Height
     *
     * @var int $_height
     */
    protected $height;
    /**
     * Border (Left, Right, Bottom, Top)
     *
     * @var string $border
     */
    protected $border;
    /**
     * Border width
     *
     * @var double $_borderWidth
     */
    protected $borderWidth;
    /**
     * Horizontal alignment (Right, Center, Left)
     *
     * @var string $_alignment
     */
    protected $alignment;
    /**
     * Fill color
     *
     * @var string $_fillColor
     */
    protected $fillColor;
    /**
     * Fill style
     *
     * @var in $_fillStyle
     */
    protected $fillStyle;
    /**
     * Text color
     *
     * @var string $_textColor
     */
    protected $textColor;
    /**
     * Field value
     *
     * @var string $_field
     */
    protected $field;
    /**
     * Element format (number, Fulldate, AbrevDate)
     *
     * @var string $_format
     */
    protected $format;
    /**
     * Element type (TextZone, PageNumber, TextField, Image...)
     *
     * @var string $_type
     */
    protected $type;
    /**
     * Element offset (difference between specified height and true height)
     * Used when Multicell is needed (auto extend = 1)
     *
     * @var int $_offset
     */
    protected $offset;

    /**
     * GetPosx
     *
     * @return int position X
     */
    public function getPosx()
    {
        return $this->posx;
    }
    /**
     * setPosx
     *
     * @param int $posx position X
     *
     * @return void
     */
    public function setPosx($posx)
    {
        $this->posx = $posx;
    }
    /**
     * GetPosy
     *
     * @return int position Y
     */
    public function getPosy()
    {
        return $this->posy;
    }
    /**
     * setPosy
     *
     * @param int $posy Position Y
     *
     * @return void
     */
    public function setPosy($posy)
    {
        $this->posy = $posy;
    }
    /**
     * getFont
     *
     * @return string font name
     */
    public function getFont()
    {
        return $this->font;
    }
    /**
     * setFont
     *
     * @param string $font font name
     *
     * @return void
     */
    public function setFont($font)
    {
        $this->font = $font;
    }
    /**
     * isAutoExtend
     *
     * @return boolean auto-extend Element
     */
    public function isAutoExtend()
    {
        return $this->isAutoExtend;
    }
    /**
     * setIsAutoExtend
     *
     * @param boolean $isAutoExtend auto-extend Element
     *
     * @return void
     */
    public function setIsAutoExtend($isAutoExtend)
    {
        $this->isAutoExtend = $isAutoExtend;
    }
    /**
     * getStyle
     *
     * @return string Font style
     */
    public function getStyle()
    {
        return $this->style;
    }
    /**
     * setStyle
     *
     * @param string $style Font style (U, I, B, N)
     *
     * @return void
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }
    /**
     * getFontSize
     *
     * @return int Font size
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }
    /**
     * setFontSize
     *
     * @param int $fontSize Font size
     *
     * @return void
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }
    /**
     * getWidth
     *
     * @return int Element width
     */
    public function getWidth()
    {
        return $this->width;
    }
    /**
     * setWidth
     *
     * @param int $width Element width
     *
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }
    /**
     * getHeight
     *
     * @return int Element height
     */
    public function getHeight()
    {
        return intval($this->height);
    }
    /**
     * setHeight
     *
     * @param int $height Element height
     *
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }
    /**
     * getHeightOffset
     *
     * @return int Element height offset
     */
    public function getHeightOffset()
    {
        return intval($this->offset);
    }
    /**
     * setHeightOffset
     *
     * @param int $value offset between desired height and real height
     *
     * @return void
     */
    public function setHeightOffset($value)
    {
        $this->offset = $value;
    }
    /**
     * getBorder
     *
     * @return int Element border
     */
    public function getBorder()
    {
        return $this->border;
    }
    /**
     * setBorder
     *
     * @param string $border Element border (L, R, B, T)
     *
     * @return void
     */
    public function setBorder($border)
    {
        $this->border = $border;
    }
    /**
     * getBorderWidth
     *
     * @return double Element border width
     */
    public function getBorderWidth()
    {
        return $this->borderWidth;
    }
    /**
     * setBorderWidth
     *
     * @param double $borderWidth Element border width
     *
     * @return void
     */
    public function setBorderWidth($borderWidth)
    {
        $this->borderWidth = $borderWidth;
    }
    /**
     * getAlignment
     *
     * @return string Horizontal alignment
     */
    public function getAlignment()
    {
        return $this->alignment;
    }
    /**
     * setAlignment
     *
     * @param string $alignment Horizontal alignment
     *
     * @return void
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;
    }
    /**
     * getFillColor
     *
     * @return string Fill Color (with #)
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }
    /**
     * setFillColor
     *
     * @param string $fillColor color (hexadecimal without #)
     *
     * @return void
     */
    public function setFillColor($fillColor)
    {
        $this->fillColor = "#" . $fillColor;
    }

    /**
     * getFillStyle
     *
     * @return string fill style
     */
    public function getFillStyle()
    {
        return $this->fillStyle;
    }
    /**
     * setFillStyle
     *
     * @param string $fillStyle Fill style F, D or FD
     * (Fill only, Borders only or Filled and Borders)
     *
     * @return void
     */
    public function setFillStyle($fillStyle)
    {
        $this->fillStyle = $fillStyle;
    }

    /**
     * getTextColor
     *
     * @return string Text Color (with #)
     */
    public function getTextColor()
    {
        return $this->textColor;
    }
    /**
     * setTextColor
     *
     * @param string $textColor color (hexadecimal without #)
     *
     * @return void
     */
    public function setTextColor($textColor)
    {
        $this->textColor = "#" . $textColor;
    }
    /**
     * getFormat
     *
     * @return string Element format
     */
    public function getFormat()
    {
        return $this->format;
    }
    /**
     * setFormat
     *
     * @param string $format Element format (Number, AbrevDate...)
     *
     * @return void
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }
    /**
     * getType
     *
     * @return string Element type
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * setType
     *
     * @param string $type Element type (TextField, TextZone...)
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    /**
     * setField
     *
     * @param string &$pdfDoc instance of PDF class
     *
     * @return void
     */
    function setField(&$pdfDoc)
    {
    }
    /**
     * getField
     *
     * @return string Element field
     */
    function getValue()
    {
        return $this->value;
    }

    /**
     * set all properties to object
     *
     * @param object $elementInfo Element with all info from data source
     *
     * @return void
     */
    function setProperties($elementInfo)
    {
        $this->posx = $elementInfo['posX'];
        $this->posy = $elementInfo['posY'];
        //$this->font = $elementInfo['fontFamily'];
        //$this->isAutoExtend = $elementInfo['isAutoExtend'];
        //$this->style = $elementInfo['style'];
        //$this->fontSize = $elementInfo['size'];
        $this->width = $elementInfo['width'];
        $this->height = $elementInfo['height'];
        //$this->border = $elementInfo['border'];
        //$this->borderWidth = $elementInfo['borderWidth'];
        //$this->alignment = $elementInfo['alignment'];
        //$this->setFillColor($elementInfo['fillColor']);
        //$this->setTextColor($elementInfo['textColor']);
        //$this->fillColor = $elementInfo['fillColor'];
        //$this->textColor = $elementInfo['textColor'];
        //$this->format = $elementInfo['format'];
        $this->type = $elementInfo['type'];
        $this->value = $elementInfo['value'];
        /*
        // calculate the cell height after extension
        if ($this->isAutoExtend != '0') {
            $cellHeight = $pdfDoc->nbLines(
                $this->width,
                $this->field,
                $this->fontSize
            ) * $this->height;
            if (RevPDF::isDebug()) {
                RevPDF::getLogger()->debug(
                    '$cellHeight needed: ' . $cellHeight .
                    ' / $this->height: ' . $this->height .
                    ' / ' . $this->width .
                    ', ' . $this->field .
                    ', ' . $this->fontSize .
                    ', ' . $this->height
                );
            }
            if ($cellHeight > $this->height) {
                $this->offset = $cellHeight - $this->height;
            }
        }*/
    }
    /**
     * Write content into instance of PDF class
     *
     * @param object &$pdfDoc instance of PDF class
     *
     * @return void
     */
    function writeContent(&$pdfDoc)
    {
        if ($this->isAutoExtend == '0') {
            $pdfDoc->Cell(
                $this->width,
                $this->height,
                $pdfDoc->transformElementField($this->field),
                $this->border,
                0,
                $this->alignment,
                1
            );
        } else {
            $pdfDoc->MultiCell(
                $this->width,
                $this->height,
                $this->field,
                $this->border,
                $this->alignment,
                1
            );
        }
    }
}