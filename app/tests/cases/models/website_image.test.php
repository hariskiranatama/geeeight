<?php
/* WebsiteImage Test cases generated on: 2010-12-20 12:12:26 : 1292824706*/
App::import('model', 'WebsiteImage');

class WebsiteImageTestCase extends CakeTestCase {
    var $fixtures = array('app.website_image');

    function startTest() {
        $this->WebsiteImage =& ClassRegistry::init('WebsiteImage');
        $this->WebsiteImage->recursive = -1;
    }

    function endTest() {
        unset($this->WebsiteImage);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $this->WebsiteImage->data = array(
            'WebsiteImage' =>
                array(
                    'id' => 5,
                    'image_for' => 'homescreen_horizontal',
                    'thumbsize' => 'normal',
                    'is_active' => 1,
                    'title' => NULL,
                    'caption' => NULL,
                    'is_new' => NULL,
                    'link_url' => NULL,
                    'weight' => 1
                ),
        );
        $result = $this->WebsiteImage->beforeValidate();
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testSaveImage() {
        //1st test
        $data = array(
            'WebsiteImage' =>
                array(
                    'id' => 5,
                    'image_for' => 'homescreen_horizontal',
                    'thumbsize' => 'normal',
                    'is_active' => 1,
                    'title' => NULL,
                    'caption' => NULL,
                    'is_new' => NULL,
                    'link_url' => NULL,
                    'weight' => 1
                ),
        );
        $result = $this->WebsiteImage->saveImage($data);
        $expected = array (
            'WebsiteImage' => array (
                'id' => 5,
                'image_for' => 'homescreen_horizontal',
                'thumbsize' => 'normal',
                'is_active' => 1,
                'title' => null,
                'caption' => null,
                'is_new' => null,
                'link_url' => null,
                'weight' => 1,
                'modified' => date('Y-m-d H:i:s')
            )
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $data = array();
        $result = $this->WebsiteImage->saveImage($data);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testGetNewWeight() {
        $result = $this->WebsiteImage->getNewWeight('homescreen_horizontal');
        $expected = 2;
        $this->assertEqual($result, $expected);
    }

    function testUp() {
        $result = $this->WebsiteImage->up(9);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testDown() {
        $result = $this->WebsiteImage->down(6);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testGetHomescreen() {
        //1st test
        $result = $this->WebsiteImage->getHomescreen('layout not in default array');
        $expected = array(
            'WebsiteImage' => array(
                'id' => 5,
                'image_for' => 'homescreen_horizontal',
                'thumbsize' => 'normal',
                'image_file' => 'ec91cda59eebda173fb0a877481f01fe.jpg',
                'dir' => 'uploads/website_image/image_file',
                'filesize' => 71149,
                'realname' => 'banner-horizontal-bg.jpg',
                'mimetype' => 'image/jpeg',
                'created' => '2010-12-15 14:05:09',
                'modified' => '2010-12-15 14:50:35',
                'is_active' => 1,
                'title' => NULL,
                'caption' => NULL,
                'is_new' => NULL,
                'link_url' => NULL,
                'weight' => 1
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->WebsiteImage->getHomescreen('vertical');
        $expected = array(
            'WebsiteImage' => array(
                'id' => 7,
                'image_for' => 'homescreen_vertical',
                'thumbsize' => 'normal',
                'image_file' => 'da366d4b2f6e8962e99234265793d47e.jpg',
                'dir' => 'uploads/website_image/image_file',
                'filesize' => 74026,
                'realname' => 'banner-vertical-bg.jpg',
                'mimetype' => 'image/jpeg',
                'created' => '2010-12-15 15:12:59',
                'modified' => '2010-12-15 15:12:59',
                'is_active' => 1,
                'title' => NULL,
                'caption' => NULL,
                'is_new' => NULL,
                'link_url' => NULL,
                'weight' => 1
            ),
        );
        $this->assertEqual($result, $expected);
        //3rd test
        $result = $this->WebsiteImage->getHomescreen('mixed');
        $expected = array(
            'WebsiteImage' => array(
                'id' => 8,
                'image_for' => 'homescreen_mix',
                'thumbsize' => 'normal',
                'image_file' => 'd24fc6ed0f5363508d60e938c3f8c274.jpg',
                'dir' => 'uploads/website_image/image_file',
                'filesize' => 67198,
                'realname' => 'banner-mix-bg.jpg',
                'mimetype' => 'image/jpeg',
                'created' => '2010-12-15 15:13:17',
                'modified' => '2010-12-15 15:13:17',
                'is_active' => 1,
                'title' => NULL,
                'caption' => NULL,
                'is_new' => NULL,
                'link_url' => NULL,
                'weight' => 1
            ),
        );
        $this->assertEqual($result, $expected);
    }

    function testGetThumbnail() {
        //1st test
        $result = $this->WebsiteImage->getThumbnails('layout not in default array');
        $expected = array(
            'portrait' => array(
                'image_for' => 'thumbnail_portrait_horizontal',
                'num'       => 6,
                'offset'    => 0,
                'images'    => array(
                    array(
                        'WebsiteImage' => array(
                            'id' => 6,
                            'image_for' => 'thumbnail_portrait_horizontal',
                            'thumbsize' => 'normal',
                            'image_file' => '5a49eb3f3864c6eb670c67a687a5e740.jpg',
                            'dir' => 'uploads/website_image/image_file',
                            'filesize' => 9443,
                            'realname' => 'arrival.jpg',
                            'mimetype' => 'image/jpeg',
                            'created' => '2010-12-15 14:36:54',
                            'modified' => '2010-12-15 16:26:03',
                            'is_active' => 1,
                            'title' => 'NEW ARRIVAL',
                            'caption' => 'Hot new & imited products  EVERYDAY',
                            'is_new' => 1,
                            'link_url' => '',
                            'weight' => 1
                        ),
                    ),
                    array(
                        'WebsiteImage' => array(
                            'id' => 9,
                            'image_for' => 'thumbnail_portrait_horizontal',
                            'thumbsize' => 'normal',
                            'image_file' => 'ad8a12fff19fc1a3a442108e117cb159.jpg',
                            'dir' => 'uploads/website_image/image_file',
                            'filesize' => 15415,
                            'realname' => 'dresses.jpg',
                            'mimetype' => 'image/jpeg',
                            'created' => '2010-12-15 16:02:45',
                            'modified' => '2010-12-16 14:53:35',
                            'is_active' => 1,
                            'title' => 'DRESSES',
                            'caption' => 'The newest must haves, featuring the Stretch Cotton',
                            'is_new' => 0,
                            'link_url' => '',
                            'weight' => 2
                        ),
                    ),
                ),
            ),
            'landscape' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
            'portrait2' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
            'landscape2' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->WebsiteImage->getThumbnails('vertical');
        $expected = array(
            'portrait' => array(
                'image_for' => 'thumbnail_portrait_vertical',
                'num'       => 2,
                'offset'    => 0,
                'images'    => array(),
            ),
            'landscape' => array(
                'image_for' => 'thumbnail_landscape_vertical',
                'num'       => 1,
                'offset'    => 0,
                'images'    => false,
            ),
            'portrait2' => array(
                'image_for' => 'thumbnail_portrait_vertical',
                'num'       => 2,
                'offset'    => 2,
                'images'    => false,
            ),
            'landscape2' => array(
                'image_for' => 'thumbnail_landscape_vertical',
                'num'       => 1,
                'offset'    => 1,
                'images'    => false,
            ),
        );
        $this->assertEqual($result, $expected);
        //3rd test
        $result = $this->WebsiteImage->getThumbnails('mixed');
        $expected = array(
            'portrait' => array(
                'image_for' => 'thumbnail_portrait_mix',
                'num'       => 1,
                'offset'    => 0,
                'images'    => array(),
            ),
            'landscape' => array(
                'image_for' => 'thumbnail_landscape_mix',
                'num'       => 4,
                'offset'    => 0,
                'images'    => false,
            ),
            'portrait2' => array(
                'image_for' => 'thumbnail_portrait_mix',
                'num'       => 1,
                'offset'    => 1,
                'images'    => false,
            ),
            'landscape2' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
        );
        $this->assertEqual($result, $expected);
    }

}
