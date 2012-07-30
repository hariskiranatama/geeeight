<?php
class SettingsController extends AppController {

    var $name = 'Settings';

    function admin_index() {
        if (!empty($this->data)) {
            if ($this->Setting->saveSettings($this->data)) {
                $this->Session->setFlash(__d("admin", 'The setting has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d("admin", 'The setting could not be saved. Please, try again.', true));
            }
        }
        $this->Setting->recursive = 0;
        $this->set('settings', $this->Setting->find('all', array(
            'order' => array(
                'setting_group' => 'asc',
                'setting_weight' => 'asc',
            ),
        )));
    }
}
