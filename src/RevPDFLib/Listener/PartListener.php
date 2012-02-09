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

namespace RevPDFLib\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * PartListener Class
 *
 * @category   PDF
 * @package    RevPDFLib
 * @subpackage Listener
 * @author     Olivier Cornu <contact@revpdf.org>
 * @license    GNU General Public License v3.0
 * @version    Release: $Revision:$
 * @link       http://www.revpdf.org
 */
class PartListener implements EventSubscriberInterface
{
    /**
     * Method linked to subscribed events
     * 
     * @param Event $event 
     * 
     * @return void
     */
    public function onResponse(Event $event)
    {
        $part = $event->getPart();
        $offset = $event->getOffset();
        
        $part->setStartPosition($offset);
    }
    
    /**
     * List of subscribed events
     * 
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array('response' => 'onResponse');
    }
}