<?php
 
namespace RevPDFLib\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
 
class PartListener implements EventSubscriberInterface
{
    public function onResponse(Event $event)
    {
        $part = $event->getPart();
        $offset = $event->getOffset();
        
        $part->setStartPosition($offset);
    }
    
    public static function getSubscribedEvents()
    {
        return array('response' => 'onResponse');
    }
}