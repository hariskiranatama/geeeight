<div class="container">
    <div class="left-menu right">
        <h2><?php __("what it's in my cart"); ?></h2>
    </div>
     <div class="main-content submit-form cart">
        <h1 class="title"><?php __('Shopping Cart'); ?></h1><hr/><br/>
        <?php if ( ! $cartItems ): ?>
            <p><?php __('Shopping Cart currently empty'); ?>!</p>
        <?php else: ?>
            <?php echo $this->Form->create(null, array('url' => array('controller' => 'carts', 'action' => 'index'), 'id' => 'cartForm')); ?>
            <table>
                <thead>
                    <tr>
                        <th class="delete"><?php __('Remove'); ?></th>
                        <th class="name"><?php __('Product Name'); ?></th>
                        <th class="ket"><?php __('Size'); ?></th>
                        <th class="price"><?php __('Price'); ?></th>
                        <th class="qty"><?php __('Quantity'); ?></th>
                        <th class="total"><?php __('Total'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
                <?php foreach ($cartItems as $cartItem): ?>
                    <tr>
                        <td class="delete"><?php echo $this->Html->link(null, '#', array('class' => 'remove-cart-item {cartItemId: '.$cartItem['CartItem']['id'].'}', 'title' => 'remove item')); ?></td>
                        <td class="name">
                            <?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $cartItem['Item'],
                                'label' => false,
                                'div' => false,
                                'thumbsize' => 'cart',
                                'default' => 'uploads/item/image_file'
                            )); ?>
                            <?php echo $this->Html->link($cartItem['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $cartItem['Item']['id'])); ?>
                        </td>
                        <td class="ket"><?php echo $cartItem['Item']['size_id']; ?></td>
                        <td class="price"><?php echo $this->Number->currency($cartItem['Item']['sales_price'], 'Rp. ', array (
                            'thousands' => '.',
                            'decimals' => ',',
                        )); ?></td>
                        <td class="qty">
                            <input type="text" value="<?php echo $cartItem['CartItem']['qty']; ?>" name="qty[<?php echo $cartItem['CartItem']['id']; ?>]" size="4" maxlength="4"/>
                        </td>
                        <td class="total"><?php echo $this->Number->currency($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty'], 'Rp. ', array (
                            'thousands' => '.',
                            'decimals' => ',',
                        )); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="col-subtotal">
                        <td colspan="5" class="subtotal"><?php __('Sub Total'); ?></td>
                        <td class="total"><?php echo $this->Number->currency($cartData['Cart']['sub_total'], 'Rp. ', array (
                            'thousands' => '.',
                            'decimals' => ',',
                        )); ?></td>
                    </tr>
                    <?php if ( $this->Session->read('Auth.User.user_type') == 'reseller' ): ?>
                        <tr >
                            <td colspan="5" class="subtotal"><?php __('Discount'); ?> <?php echo number_format($cartData['Cart']['discount_pct'], 0); ?>%</td>
                            <td class="total"><?php echo $this->Number->currency($cartData['Cart']['sub_total'] - $cartData['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?></td>
                        </tr>
                        <tr class="col-subtotal">
                            <td colspan="5" class="subtotal"><?php __('Total after discount'); ?></td>
                            <td class="total"><?php echo $this->Number->currency($cartData['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?></td>
                        </tr>
                    <?php endif; ?>
                </tfoot>
            </table>
            <div>
                <input id="checkout" type="image" src="<?php echo $this->webroot; ?>images/checkout.png" class="but-checkout" />
                <a class="but-continue" href="<?php echo $this->webroot; ?>" title="continue shopping"></a>
                <input id="update" type="image" src="<?php echo $this->webroot; ?>images/update.png" class="update-cart" />
                <div class="clear"></div>
            </div>
            <?php echo $this->Form->hidden(null, array(
                'id' => 'cartItemId',
                'name' => 'cartItemId',
            )); ?>
            <?php echo $this->Form->hidden(null, array(
                'id' => 'isCheckout',
                'name' => 'isCheckout',
                'value' => '0',
            )); ?>
            <?php echo $this->Form->end(); ?>
            <div class="paging">
                <?php echo $this->Paginator->prev('<< ' . __('previous | ', true), array(), null, array('class'=>'disabled')); ?>
                <?php echo $this->Paginator->numbers(); ?>
                <?php echo $this->Paginator->next(__(' | next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $html->script('jquery/jquery.metadata.min'); ?>
<?php echo $html->script('app/carts_index'); ?>
