<?php
/* Item Test cases generated on: 2010-12-20 09:12:02 : 1292813522*/
App::import('model', 'Item');

class ItemTestCase extends CakeTestCase {
    var $fixtures = array(
        'app.m_item',
        'app.m_item_brand',
        'app.m_item_type',
        'app.category',
        'app.m_item_group',
        'app.m_item_size',
        'app.m_item_color',
        'app.item_image',
        'app.stock_history',
        'app.tag',
        'app.items_tag',
        'app.item_recomend',
    );

    function startTest() {
        $this->Item =& ClassRegistry::init('Item');
        $this->Item->recursive = -1;
    }

    function endTest() {
        unset($this->Item);
        ClassRegistry::flush();
    }

    function testView() {
        //1st test
        $id = 1;
        $result = $this->Item->view($id);
        $expected = array(
            'Item' => array(
                'id' => 1,
                'item_id' => 'GEE03G00001PPLG',
                'item_name' => 'J121 ',
                'brand_id' => 'GEE',
                'type_id' => '03',
                'group_id' => 'G',
                'size_id' => 'LG',
                'color_id' => 'PP',
                'article_id' => '',
                'cost_price' => 125000.00,
                'pricing_method' => 'M',
                'margin' => '0.00',
                'margin_pct' => '0.00',
                'sales_price' => 125000.00,
                'discount_pct' => '0.00',
                'active' => 'F',
                'is_upcome' => 'F',
                'description' => NULL,
                'image_file' => NULL,
                'dir' => NULL,
                'filesize' => NULL,
                'realname' => NULL,
                'mimetype' => NULL,
                'read_count' => 2,
                'last_view_time' => '2010-12-17 14:54:19',
                'is_recommended' => NULL,
                'created' => '2010-09-27 11:00:15',
                'modified' => '2010-09-27 11:00:15',
                'total_stock' => 11,
                'actual_stock' => 11,
                'booked_stock' => NULL,
                'release_stock' => NULL,
                'reject_stock' => NULL
            ),
            'ItemBrand' => array(
                'brand_id' => 'GEE',
                'brand_name' => 'Gee Eight',
                'brand_logo' => 'GEE_20100720_190047.jpg',
                'active' => 'T',
                'created' => '2010-11-15 14:55:54',
                'modified' => '2010-11-15 14:55:54'
            ),
            'ItemType' => array(
                'type_id' => NULL,
                'type_name' => NULL,
                'category_id' => NULL,
                'active' => NULL,
                'image_file' => NULL,
                'dir' => NULL,
                'filesize' => NULL,
                'realname' => NULL,
                'mimetype' => NULL,
                'created' => NULL,
                'modified' => NULL,
                'original_category_id' => NULL,
            ),
            'ItemGroup' => array(
                'group_id' => NULL,
                'group_name' => NULL,
                'active' => NULL,
                'created' => NULL,
                'modified' => NULL,
            ),
            'ItemSize' => array(
                'size_id' => NULL,
                'size' => NULL,
                'active' => NULL,
                'created' => NULL,
                'modified' => NULL,
            ),
            'ItemColor' => array(
                'color_id' => NULL,
                'color_name' => NULL,
                'hexa_decimal' => NULL,
                'active' => NULL,
                'created' => NULL,
                'modified' => NULL,
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 3;
        $result = $this->Item->view($id);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testStockValidation() {
        $result = $this->Item->stock_validation();
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testReadStock() {
        //1st test
        $id = 1;
        $result = $this->Item->read_stock(array('actual_stock'), $id);
        $expected = array(
            'Item' => array(
                'actual_stock' => 11,
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 3;
        $result = $this->Item->read_stock(null, $id);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testAddStock() {
        //1st test
        $data = array(
            'Item' => array(
                'id' => 1,
                'new_stock' => 5,
            ),
        );
        $result = $this->Item->add_stock($data);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $data = array(
            'Item' => array(
                'id' => 3,
                'new_stock' => 5,
            ),
        );
        $result = $this->Item->add_stock($data);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testStockAvailable() {
        //1st test
        $result = $this->Item->stockAvailable (1, 10);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Item->stockAvailable (1, 100);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testReduceStock() {
        //1st test
        $result = $this->Item->reduceStock (1, 10);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Item->reduceStock (1, 100);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testRestoreStock() {
        //1st test
        $result = $this->Item->restoreStock (1, 10);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Item->restoreStock (1, -10);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

}
