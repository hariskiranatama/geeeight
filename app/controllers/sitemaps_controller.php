<?php
class SitemapsController extends AppController{

    var $name = 'Sitemaps';
    //var $uses = array('Post', 'Info');
    
    var $uses = array('Event', 'Album', 'Category', 'Item', 'InfoPage');
    
    var $helpers = array('Time');
    var $components = array('RequestHandler');

    function index (){    
        $this->set('categories', $this->Category->find('all', array(
            'fields' => array('name', 'modified','id'),
        )));
        $this->set('items', $this->Item->find('all', array(
            'fields' => array('item_name', 'modified', 'id'),
            'group' => array('item_name'),
        )));
        $this->set('albums', $this->Album->find('all', array(
            'fields' => array('album_name', 'modified', 'id'),
        )));
        $this->set('events', $this->Event->find('all', array(
            'conditions' => array(
                'is_published' => 1,
            ),
            'fields' => array('title', 'title_en', 'modified','id'),
        )));
        $this->set('infopages', $this->InfoPage->find('all', array(
            'fields' => array('title', 'title_en', 'modified','id'),
        )));
        
        //debug logs will destroy xml format, make sure were not in debug mode
        Configure::write ('debug', 0);
    }
}