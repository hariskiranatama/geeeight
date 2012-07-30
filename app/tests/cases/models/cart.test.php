<?php
/* Cart Test cases generated on: 2010-12-20 11:12:24 : 1292819904*/
App::import('model', 'Cart');

class CartTestCase extends CakeTestCase {
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
        $this->Cart =& ClassRegistry::init('Cart');
        $this->Cart->recursive = -1;
    }

    function endTest() {
        unset($this->Cart);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $result = $this->Cart->beforeValidate();
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testSetStatus() {
        //1st test
        $result = $this->Cart->setStatus(5, 'confirmed');
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Cart->setStatus(5, 'invalid status');
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testGetOpenCart() {
        //1st test
        $result = $this->Cart->getOpenCart(8);
        $expected = array(
            'Cart' => array(
                'id' => 6,
                'user_id' => 8,
                'status' => 'open',
                'created' => '2010-12-14 10:13:49',
                'modified' => '2010-12-14 10:13:49',
                'invoice_number' => NULL,
                'invoice_date' => NULL,
                'shipping_address' => NULL,
                'transactions_code' => NULL,
                'shipping_phone_number' => NULL,
                'discount_pct' => NULL
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Cart->getOpenCart(1);
        $expected = array(
            'Cart' => array(
                'id' => 7,
                'user_id' => 1,
                'status' => 'open',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'invoice_number' => NULL,
                'invoice_date' => NULL,
                'shipping_address' => NULL,
                'transactions_code' => NULL,
                'shipping_phone_number' => NULL,
                'discount_pct' => NULL
            ),
        );
        $this->assertEqual($result, $expected);
    }

    function testBuy() {
        //1st test
        $result = $this->Cart->buy(8, 1);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Cart->buy(8, 2);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testUpdateQty() {
        //1st test
        $result = $this->Cart->updateQty(5, 5, 5);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Cart->updateQty(5, 5, 50);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testRemoveItem() {
        //1st test
        $result = $this->Cart->removeItem(5, 5);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Cart->removeItem(5, 1);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testDiscountValidation() {
        $result = $this->Cart->discount_validation();
        $expected = null;
        $this->assertEqual($result, $expected);
    }

    function testChangeDiscount() {
        //1st test
        $data = array(
            'Cart' => array(
                'id' => 5,
                'discount_pct' => 10,
            ),
        );
        $result = $this->Cart->change_discount($data);
        $expected = true;
        $this->assertEqual($result, $expected);
        //2nd test
        $data = array(
            'Cart' => array(
                'id' => 5,
                'discount_pct' => 110,
            ),
        );
        $result = $this->Cart->change_discount($data);
        $expected = false;
        $this->assertEqual($result, $expected);
    }

}
