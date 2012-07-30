<?php

$this->set('documentData', array(
    'xmlns:dc'    => 'http://purl.org/dc/elements/1.1/',
    'xmlns:atom'  => 'http://www.w3.org/2005/Atom'
));

$this->set('channel', array(
    'title'         => $title_for_layout,
    'link'          => $this->Html->url('/', true),
    'description'   => __("Latest News and Events", true),
    'language'      => 'en-us'
));

echo '<atom:link href="'.$this->Html->url('index.rss', true).'" rel="self" type="application/rss+xml" />';

foreach ( $events as $event ) {
    $eventLink = array(
        'controller' => 'events',
        'action' => 'view',
        $event['Event']['id']);
    // You should import Sanitize
    App::import('Sanitize');
    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $event['Event']['content']);
    $bodyText = $this->Text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $this->Text->truncate($bodyText, 600, array('ending' => '&#8230;', 'exact' => true, 'html' => true));

    echo $this->Rss->item(array(), array(
        'title' => $event['Event']['title'],
        'link' => $eventLink,
        'guid' => array('url' => $eventLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'dc:creator' => $event['User']['full_name'],
        'pubDate' => $event['Event']['modified']
    ));
}
