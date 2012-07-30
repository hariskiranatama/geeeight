<?php
class InfoPagesController extends AppController {
    var $name = 'InfoPages';
    
    var $paginate = array(
        'InfoPage' => array(
            'limit' => 10,
            'order' => array(
                'InfoPage.modified' => 'desc'
            ),
        )
    );    
    
    function index($id = null){
        $this->set('left_menu', true);
        if (($id == 7) OR ($id == 9)){
            $this->set('left_menu', false);
        }
        $this->set('about_us', false);
        if ($id == 1){
            $this->set('about_us', true);
        }
        $this->InfoPage->id = $id;
        $data = $this->InfoPage->read();
        //read language
        $language = $this->Session->read('Config.language');
        $title = $data['InfoPage']['title'];
        if ( $language == 'eng' AND $data['InfoPage']['title_en'] ) {
            $title = $data['InfoPage']['title_en'];
        }
        $this->set('infopagesread', $data);
        $this->set('title_for_layout', $title);
    }
    
    function admin_index(){
        $this->set('infopages', $this->paginate('InfoPage'));
    }
    
    function admin_edit($id = null){
        $this->set('title', $this->InfoPage->find('list', array('fields' => array('id', 'title'))));
        $this->set('title_en', $this->InfoPage->find('list', array('fields' => array('id', 'title_en'))));
        
        $this->InfoPage->id = $id;
        if (empty($this->data)){
        $this->data = $this->InfoPage->read();
        }
        else{
            if ($this->InfoPage->save($this->data)){
                $this->Session->setFlash(__d("admin", 'Information have been updated.', true));
                $this->redirect(array('admin' => true, 'controller' => 'info_pages', 'action' => 'view', $id));
            }
        }
    }
    
    function admin_view($id = null) {
        $data = $this->InfoPage->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Informations data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'info_pages', 'action' => 'index'));
        }
        $this->set('infopages', $data);
        $this->set('title_for_layout', __d("admin", 'Information Detail', true));
    }
}