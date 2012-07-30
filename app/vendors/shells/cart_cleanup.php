<?php

class CartCleanupShell extends Shell {
    var $uses = array('Cart', 'User');

    function main() {
        //get cart that last modified is more than 2 days ago
        $twoDaysAgo = date('Y-m-d H:i:s', strtotime('-2 day'));
        $carts = $this->Cart->find("all", array(
            'conditions' => array(
                'Cart.status' => 'open',
                'Cart.modified <= ' => $twoDaysAgo,
                'User.user_type' => 'buyer',
            ),
        ));
        if ( $carts ) {
            foreach ( $carts as $cart ) {
                //debug
                $this->out("Will delete cart id={$cart['Cart']['id']}, belongs to user={$cart['User']['full_name']}, user type is {$cart['User']['user_type']} last modified on {$cart['Cart']['modified']}");
                $this->Cart->delete($cart['Cart']['id']);
                $this->out("Cart id={$cart['Cart']['id']} have been deleted!");
            }
    		$this->hr();
        }
    }

    function _welcome() {
		$this->hr();
		$this->out('Cart Cleanup');
		$this->hr();
	}
}
