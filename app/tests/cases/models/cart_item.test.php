<?php
/* CartItem Test cases generated on: 2010-12-20 11:12:27 : 1292819907*/
App::import('model', 'CartItem');

class CartItemTestCase extends CakeTestCase {
    var $fixtures = array(
        'app.cart_item',
        'app.cart',
        'app.user',
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
        $this->CartItem =& ClassRegistry::init('CartItem');
        $this->CartItem->recursive = -1;
    }

    function endTest() {
        unset($this->CartItem);
        ClassRegistry::flush();
    }

    function testUpdateQty() {
        //1st test
        $result = $this->CartItem->updateQty(5, 10);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->CartItem->updateQty(5, 100);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testBuyItem() {
        //1st test
        $result = $this->CartItem->buyItem(5, 1);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->CartItem->buyItem(6, 1);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testBeforeDelete() {
        $this->CartItem->id = 5;
        $result = $this->CartItem->beforeDelete(true);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testAfterDelete() {
        $this->CartItem->deletedItems = array(
            5 => 3,
        );
        $result = $this->CartItem->afterDelete();
        $expected = null;
        $this->assertEqual($result, $expected);
    }

}
