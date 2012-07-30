<?php
class WebsiteImagesController extends AppController {

    var $name = 'WebsiteImages';

    function admin_index($layout = null) {
        if ( ! in_array($layout, array('hor', 'ver', 'mix')) ){
            $this->redirect(array('controller' => 'settings', 'action' => 'index'));
        }
        //set condition and title
        $add_param = array(
            'homescreen' => false,
            'landscape' => false,
            'portrait' => false,
        );
        $conditions = array();
        $title = '';
        if ( $layout === 'hor' ) {
            $hor_param = array(
                'homescreen' => 'homescreen_horizontal',
                'portrait' => 'thumbnail_portrait_horizontal',
            );
            $add_param = array_merge($add_param, $hor_param);
            $conditions = array(
                'image_for' => array_values($hor_param),
            );
            $title = __d("admin", 'Images for Horizontal Layout', true);
        }
        elseif ( $layout === 'ver' ) {
            $add_param = array(
                'homescreen' => 'homescreen_vertical',
                'landscape' => 'thumbnail_landscape_vertical',
                'portrait' => 'thumbnail_portrait_vertical',
            );
            $conditions = array(
                'image_for' => array_values($add_param),
            );
            $title = __d("admin", 'Images for Vertical Layout', true);
        }
        elseif ( $layout === 'mix' ) {
            $add_param = array(
                'homescreen' => 'homescreen_mix',
                'landscape' => 'thumbnail_landscape_mix',
                'portrait' => 'thumbnail_portrait_mix',
            );
            $conditions = array(
                'image_for' => array_values($add_param),
            );
            $title = __d("admin", 'Images for Mixed Layout', true);
        }
        //set pagination
        $this->paginate = array(
            'WebsiteImage' => array(
                'limit' => 20,
                'conditions' => $conditions,
                'order' => array(
                    'WebsiteImage.image_for' => 'asc',
                    'WebsiteImage.weight' => 'asc',
                ),
            )
        );
        $this->WebsiteImage->recursive = 0;
        $this->set('websiteImages', $this->paginate('WebsiteImage'));
        $this->set('imageForOptions', $this->WebsiteImage->imageForOptions);
        $this->set('title_for_layout', $title);
        $this->set('add_param', $add_param);
    }

    function admin_up($id = null) {
         if ($this->WebsiteImage->up($id)){
            $this->Session->setFlash(__d("admin", 'Image arranged!', true));
        }
        $this->redirect($this->referer());
    }

    function admin_down($id = null) {
         if ($this->WebsiteImage->down($id)){
            $this->Session->setFlash(__d("admin", 'Image arranged!', true));
        }
        $this->redirect($this->referer());
    }

    function admin_view($id = null) {
        if ( ! $id ) {
            $this->Session->setFlash(__d("admin", 'Invalid image', true));
            $this->redirect(array('action' => 'index', 'hor'));
        }
        $websiteImage = $this->WebsiteImage->read(null, $id);
        if ( ! $websiteImage ) {
            $this->Session->setFlash(__d("admin", 'Invalid image', true));
            $this->redirect(array('action' => 'index', 'hor'));
        }

        $image_for = $websiteImage['WebsiteImage']['image_for'];
        $title = $this->WebsiteImage->imageForWithLayoutOptions[$image_for];
        //set data
        $this->set(compact('websiteImage'));
        $this->set('title_for_layout', $title);
    }

    function admin_add($image_for = null) {
        $validImageFor = array_keys($this->WebsiteImage->imageForOptions);
        if (!empty($this->data)) {
            $image_for = $this->data['WebsiteImage']['image_for'];
        }
        if ( ! in_array($image_for, $validImageFor) ) {
             $this->redirect(array('action' => 'index', 'hor'));
        }
        if (!empty($this->data)) {
            $this->WebsiteImage->create();
            $this->data['WebsiteImage']['weight'] = $this->WebsiteImage->getNewWeight($this->data['WebsiteImage']['image_for']);
            if ($this->WebsiteImage->saveImage($this->data)) {
                $this->Session->setFlash(__d("admin", 'The image has been saved', true));
                $this->redirect(array('action' => 'view', $this->WebsiteImage->id));
            } else {
                $this->Session->setFlash(__d("admin", 'The image could not be saved. Please, try again.', true));
            }
        }

        $title = 'New ' . $this->WebsiteImage->imageForWithLayoutOptions[$image_for];
        $sizepixel = $this->WebsiteImage->sizePixelLabel[$image_for];
        $cancel_link_param = 'hor';
        if (preg_match('/_vertical$/', $image_for, $matches) > 0) {
            $cancel_link_param = 'ver';
        }
        elseif (preg_match('/_mix$/', $image_for, $matches) > 0) {
            $cancel_link_param = 'mix';
        }
        //set data
        $this->set('image_for', $image_for);
        $this->set('title_for_layout', $title);
        $this->set('cancel_link_param', $cancel_link_param);
        $this->set('sizepixel', $sizepixel);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid website image', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->WebsiteImage->saveImage($this->data)) {
                $this->Session->setFlash(__d("admin", 'The image has been saved', true));
                $this->redirect(array('action' => 'view', $this->WebsiteImage->id));
            } else {
                $this->Session->setFlash(__d("admin", 'The image could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->WebsiteImage->read(null, $id);
        }

        $image_for = $this->data['WebsiteImage']['image_for'];
        $title = 'Edit ' . $this->WebsiteImage->imageForWithLayoutOptions[$image_for];
        $sizepixel = $this->WebsiteImage->sizePixelLabel[$image_for];
        $cancel_link_param = 'hor';
        if (preg_match('/_vertical$/', $image_for, $matches) > 0) {
            $cancel_link_param = 'ver';
        }
        elseif (preg_match('/_mix$/', $image_for, $matches) > 0) {
            $cancel_link_param = 'mix';
        }
        //set data
        $this->set('title_for_layout', $title);
        $this->set('cancel_link_param', $cancel_link_param);
        $this->set('sizepixel', $sizepixel);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for image', true));
            $this->redirect($this->referer());
        }
        if ($this->WebsiteImage->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Image deleted', true));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__d("admin", 'Image was not deleted', true));
        $this->redirect($this->referer());
    }
}
