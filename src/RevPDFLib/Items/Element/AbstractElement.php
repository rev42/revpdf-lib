<?php
/**
 * $Id:$
 *
 * PHP version 5
 *
 * @category  PDF
 * @package   RevPDFLib
 * @author    Olivier Cornu <contact@revpdf.org>
 * @copyright 2007-2010 Olivier Cornu
 * @license   GNU General Public License v3.0
 * @version   SVN: $Id:$
 * @link      http://www.revpdf.org
 *
 * This package can be redistributed and/or modified
 * under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This package is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License; if not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace RevPDFLib\Items\Element;

/**
 * Element Abstract Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
abstract class AbstractElement
{
    /**
     * Position x
     *
     * @var int $posx
     */
    protected $posx;
    /**
     * Position y
     *
     * @var int $posy
     */
    protected $posy;
    /**
     * font name
     *
     * @var string $font
     */
    protected $font;
    /**
     * Should element be extended if content is overlapping
     *
     * @var boolean $isAutoExtend
     */
    protected $isAutoExtend;
    /**
     * Font style (Underline, Italic, Bold, Normal)
     *
     * @var string $style
     */
    protected $style;
    /**
     * Font size
     *
     * @var in $fontSize
     */
    protected $fontSize;
    /**
     * Width
     *
     * @var int $width
     */
    protected $width;
    /**
     * Height
     *
     * @var int $height
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
     * @var double $borderWidth
     */
    protected $borderWidth;
    /**
     * Horizontal alignment (Right, Center, Left)
     *
     * @var string $alignment
     */
    protected $alignment;
    /**
     * Fill color
     *
     * @var string $fillColor
     */
    protected $fillColor;
    /**
     * Fill style
     *
     * @var in $fillStyle
     */
    protected $fillStyle;
    /**
     * Text color
     *
     * @var string $textColor
     */
    protected $textColor;
    /**
     * Field value
     *
     * @var string $field
     */
    protected $field;
    /**
     * Element format (number, Fulldate, AbrevDate)
     *
     * @var string $format
     */
    protected $format;
    /**
     * Element type (TextZone, PageNumber, TextField, Image...)
     *
     * @var string $type
     */
    protected $type;
    /**
     * Element offset (difference between specified height and true height)
     * Used when Multicell is needed (auto extend = 1)
     *
     * @var int $offset
     */
    protected $offset;

    /**
     * Get Position x
     *
     * @return int position X
     */
    public function getPosx()
    {
        return $this->posx;
    }
    /**
     * set Position x
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
     * Get Position y
     *
     * @return int position Y
     */
    public function getPosy()
    {
        return $this->posy;
    }
    /**
     * set Position y
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
     * get Font
     *
     * @return string font name
     */
    public function getFont()
    {
        return $this->font;
    }
    /**
     * set Font
     *
     * @param string $font Font name
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
        return (int) $this->isAutoExtend;
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
     * get Style
     *
     * @return string Font style
     */
    public function getStyle()
    {
        return $this->style;
    }
    /**
     * Set Style
     *
     * @param string $style Font style (U, I, B, N)
     *
     * @return void
     */
    public function setStyle($style)
    {
        $allowedValues = array('U', 'I', 'B', 'N');
        $values = str_split($style);
        $result = array_intersect($allowedValues, $values);
        
        $this->style = implode('', $result);
    }
    /**
     * get Font Size
     *
     * @return int Font size
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }
    /**
     * set Font Size
     *
     * @param int $fontSize Font size
     *
     * @return void
     */
    public function setFontSize($fontSize)
    {
        if ($fontSize <= 0 || !is_numeric($fontSize)) {
            $fontSize = 12;
        }
        $this->fontSize = $fontSize;
    }
    /**
     * get Width
     *
     * @return int Element width
     */
    public function getWidth()
    {
        return intval($this->width);
    }
    /**
     * set Width
     *
     * @param int $width Element width
     *
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = (int) $width;
    }
    /**
     * get Height
     *
     * @return int Element height
     */
    public function getHeight()
    {
        return intval($this->height);
    }
    /**
     * set Height
     *
     * @param int $height Element height
     *
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = (int) $height;
    }
    /**
     * get Height Offset
     *
     * @return int Element height offset
     */
    public function getHeightOffset()
    {
        return intval($this->offset);
    }
    /**
     * set Height Offset
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
     * get Border
     *
     * @return int Element border
     */
    public function getBorder()
    {
        return $this->border;
    }
    /**
     * set Border
     *
     * @param string $border Element border (L, R, B, T)
     *
     * @return void
     */
    public function setBorder($border)
    {
        $allowedValues = array('L', 'R', 'B', 'T');
        $values = str_split($border);
        $result = array_intersect($allowedValues, $values);
        
        $this->border = implode('', $result);
    }
    /**
     * get Border Width
     *
     * @return double Element border width
     */
    public function getBorderWidth()
    {
        return $this->borderWidth;
    }
    /**
     * set Border Width
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
     * get Alignment
     *
     * @return string Horizontal alignment
     */
    public function getAlignment()
    {
        return $this->alignment;
    }
    /**
     * set Alignment
     *
     * @param string $alignment Horizontal alignment (L, C or R)
     *
     * @return void
     */
    public function setAlignment($alignment)
    {
        $allowedAlignements = array('L', 'C', 'R');
        if (!in_array($alignment, $allowedAlignements)) {
            $alignment = 'L';
        }
        $this->alignment = $alignment;
    }
    /**
     * get Fill Color
     *
     * @return string Fill Color (with #)
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }
    /**
     * set Fill Color
     *
     * @param string $fillColor color (hexadecimal without #)
     *
     * @return void
     */
    public function setFillColor($fillColor)
    {
        if ($fillColor[0] != '#') {
            $fillColor = "#" . $fillColor;
        }
        $this->fillColor = $fillColor;
    }

    /**
     * get Fill Style
     *
     * @return string fill style
     */
    public function getFillStyle()
    {
        return $this->fillStyle;
    }
    /**
     * set Fill Style
     *
     * @param string $fillStyle Fill style F, D or FD
     * (Fill only, Borders only or Filled and Borders)
     *
     * @return void
     */
    public function setFillStyle($fillStyle)
    {
        $allowedValues = array('F', 'D');
        $values = str_split($fillStyle);
        $result = array_intersect($allowedValues, $values);
        
        $this->fillStyle = implode('', $result);
    }

    /**
     * get Text Color
     *
     * @return string Text Color (with #)
     */
    public function getTextColor()
    {
        return $this->textColor;
    }
    /**
     * set Text Color
     *
     * @param string $textColor color (hexadecimal without #)
     *
     * @return void
     */
    public function setTextColor($textColor)
    {
        if ($textColor[0] != '#') {
            $textColor = "#" . $textColor;
        }
        $this->textColor = $textColor;
    }
    /**
     * get Format
     *
     * @return string Element format
     */
    public function getFormat()
    {
        return $this->format;
    }
    /**
     * set Format
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
     * get Type
     *
     * @return string Element type
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * set Type
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
     * getField
     *
     * @return string Element field
     */
    function getField($iterator = null)
    {
        return $this->field;
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
        $defaults = array(
            'posX' => 0,
            'posY' => 0,
            'width' => 50,
            'height' => 10,
            'border' => 0,
            'type' => 'textField',
            'field' => ''
        );
        $elementInfo = array_merge($defaults, $elementInfo);
        
        $this->posx = $elementInfo['posX'];
        $this->posy = $elementInfo['posY'];
        //$this->font = $elementInfo['fontFamily'];
        //$this->isAutoExtend = $elementInfo['isAutoExtend'];
        //$this->style = $elementInfo['style'];
        //$this->fontSize = $elementInfo['size'];
        $this->width = $elementInfo['width'];
        $this->height = $elementInfo['height'];
        $this->border = $elementInfo['border'];
        //$this->borderWidth = $elementInfo['borderWidth'];
        //$this->alignment = $elementInfo['alignment'];
        //$this->setFillColor($elementInfo['fillColor']);
        //$this->setTextColor($elementInfo['textColor']);
        //$this->fillColor = $elementInfo['fillColor'];
        //$this->textColor = $elementInfo['textColor'];
        //$this->format = $elementInfo['format'];
        $this->type = $elementInfo['type'];
        $this->field = $elementInfo['value'];
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