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

namespace RevPDFLib;

use Symfony\Component\EventDispatcher\EventDispatcher;
use RevPDFLib\Listener\PartListener;
use RevPDFLib\Items\Part;

/**
 * Report Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Items
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class Report
{
    protected $author;
    protected $displayModeZoom;
    protected $displayModeLayout;
    protected $keywords;
    protected $subject;
    protected $title;
    protected $leftMargin;
    protected $topMargin;
    protected $rightMargin;
    protected $bottomMargin;
    protected $pageOrientation;
    protected $paperFormat;
    protected $parts = array();
    protected $dispatcher;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dispatcher = new EventDispatcher();
        $this->dispatcher->addSubscriber(new PartListener());
    }

    /**
     * Set all object properties
     *
     * @param array $data Data
     *
     * @return void
     */
    public function setAllProperties($data)
    {
        $data['report'] = array_merge(
            array(
                'author' => '',
                'keywords' => '',
                'subject' => '',
                'title' => '',
                'leftMargin' => 10,
                'topMargin' => 10,
                'rightMargin' => 10,
                'bottomMargin' => 10,
                'displayModeZoom' => 'default',
                'displayModeLayout' => 'default',
                'paperFormat' => 'A4',
                'pageOrientation' => 'P',
            ), $data['report']
        );
        $this->author = $data['report']['author'];
        $this->displayModeZoom = $data['report']['displayModeZoom'];
        $this->displayModeLayout = $data['report']['displayModeLayout'];
        $this->keywords = $data['report']['keywords'];
        $this->subject = $data['report']['subject'];
        $this->title = $data['report']['title'];
        $this->leftMargin = $data['report']['leftMargin'];
        $this->topMargin = $data['report']['topMargin'];
        $this->rightMargin = $data['report']['rightMargin'];
        $this->bottomMargin = $data['report']['bottomMargin'];
        $this->pageOrientation = $data['report']['pageOrientation'];
        $this->paperFormat = $data['report']['paperFormat'];
    }

    /**
     * Return all object properties
     *
     * @return array
     */
    public function getAllProperties()
    {
        return get_object_vars($this);
    }

    /**
     * Get Author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param string $author Author
     *
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get Display Mode Zoom
     *
     * @return string
     */
    public function getDisplayModeZoom()
    {
        return $this->displayModeZoom;
    }

    /**
     * Set Display Mode Zoom
     *
     * @param string $displayModeZoom display Mode Zoom
     *
     * @return void
     */
    public function setDisplayModeZoom($displayModeZoom)
    {
        $this->displayModeZoom = $displayModeZoom;
    }

    /**
     * Get Display Mode Layout
     *
     * @return string
     */
    public function getDisplayModeLayout()
    {
        return $this->displayModeLayout;
    }

    /**
     * Set Display Mode Layout
     *
     * @param string $displayModeLayout display Mode Layout
     *
     * @return void
     */
    public function setDisplayModeLayout($displayModeLayout)
    {
        $this->displayModeLayout = $displayModeLayout;
    }

    /**
     * Get Keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set Keywords
     *
     * @param string $keywords keywords
     *
     * @return void
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Get Subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set Subject
     *
     * @param string $subject subject
     *
     * @return void
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param string $title title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get Left Margin
     *
     * @return int
     */
    public function getLeftMargin()
    {
        return $this->leftMargin;
    }

    /**
     * Set Left Margin
     *
     * @param int $leftMargin Left Margin
     *
     * @return void
     */
    public function setLeftMargin($leftMargin)
    {
        $this->leftMargin = (int) $leftMargin;
    }

    /**
     * Get Top Margin
     *
     * @return int
     */
    public function getTopMargin()
    {
        return (int) $this->topMargin;
    }

    /**
     * Set Top Margin
     *
     * @param int $topMargin Top Margin
     *
     * @return void
     */
    public function setTopMargin($topMargin)
    {
        $this->topMargin = (int) $topMargin;
    }

    /**
     * Get Right Margin
     *
     * @return int
     */
    public function getRightMargin()
    {
        return (int) $this->rightMargin;
    }

    /**
     * Set Right Margin
     *
     * @param int $rightMargin Right Margin
     *
     * @return void
     */
    public function setRightMargin($rightMargin)
    {
        $this->rightMargin = (int) $rightMargin;
    }

    /**
     * Get Bottom Margin
     *
     * @return int
     */
    public function getBottomMargin()
    {
        return (int) $this->bottomMargin;
    }

    /**
     * Set Bottom Margin
     *
     * @param int $bottomMargin Bottom Margin
     *
     * @return void
     */
    public function setBottomMargin($bottomMargin)
    {
        $this->bottomMargin = (int) $bottomMargin;
    }

    /**
     * Get Page Orientation
     *
     * @return char
     */
    public function getPageOrientation()
    {
        return $this->pageOrientation;
    }

    /**
     * Set Page Orientation
     *
     * @param char $pageOrientation Page Orientation
     *
     * @return void
     */
    public function setPageOrientation($pageOrientation)
    {
        $this->pageOrientation = 'P';

        if (in_array($pageOrientation, array('P', 'L'))) {
            $this->pageOrientation = $pageOrientation;
        }
    }
    /**
     * Get Paper format
     *
     * @return string
     */
    public function getPaperFormat()
    {
        return $this->paperFormat;
    }

    /**
     * Set Paper Format
     *
     * @param char $paperFormat Paper Format
     *
     * @return void
     */
    public function setPaperFormat($paperFormat)
    {
        $this->paperFormat = 'A4';

        if (in_array($paperFormat, array('A4', 'A3'))) {
            $this->paperFormat = $paperFormat;
        }
    }

    /**
     * Add new part to report
     *
     * @param string       $type Part type
     * @param Part\AbstractPart $part Part
     */
    public function addPart($type, Part\AbstractPart $part)
    {
        $this->parts[strtolower($type)] = $part;
        $this->orderedParts[$part->getIdentifier()] = $part;
        $this->calculateStartPosition();
    }

    /**
     * Recalculate Start Position for all Parts
     *
     * @return void
     */
    public function calculateStartPosition()
    {
        $offset = 0;
        ksort($this->orderedParts, SORT_NUMERIC);
        $obj = new \ArrayObject($this->orderedParts);
        $iterator = $obj->getIterator();
        while ($iterator->valid()) {
            $itPart = $iterator->current();
            $itPart->setStartPosition($offset+$this->getTopMargin());
            if ($itPart->isVisible()) {
                $offset += $itPart->getHeight();
            }
            $iterator->next();
        }
    }

    /**
     * Get Parts
     *
     * @return array
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * Get Part
     *
     * @param string $type Part Type
     *
     * @return null|array
     */
    public function getPart($type)
    {
        if (isset($this->parts[strtolower($type)])) {
            return $this->parts[strtolower($type)];
        } else {
            return null;
        }
    }

}
