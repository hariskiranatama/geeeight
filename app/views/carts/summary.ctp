<div class="container">
    <div class="left-menu right">
        <h2><?php __("what it's in my cart"); ?></h2>
    </div>
     <div class="main-content submit-form cart transaction">
        <h1 class="title"><?php __('Summary'); ?></h1><hr/><br/>
        <table>
            <thead>
                <tr>
                    <th class="name"><?php __('Product Name'); ?></th>
                    <th class="ket"><?php __('Size'); ?></th>
                    <th class="price"><?php __('Price'); ?></th>
                    <th class="qty"><?php __('Quantity'); ?></th>
                    <th class="total"><?php __('Total'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $cartItem): ?>
                    <tr>
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
                        <td class="ket">
                            <?php echo $cartItem['Item']['size_id']; ?>
                        </td>
                        <td class="price">
                            <?php echo $this->Number->currency($cartItem['Item']['sales_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                        <td class="qty">
                            <?php echo number_format($cartItem['CartItem']['qty']); ?>
                        </td>
                        <td class="total">
                            <?php echo $this->Number->currency($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="col-subtotal">
                    <td colspan="4" class="subtotal"><?php __('Sub Total'); ?></td>
                    <td class="total">
                    	<?php if(isset($cartItem)): ?>
	                        <?php echo $this->Number->currency($cartItem['Cart']['sub_total'], 'Rp. ', array (
	                            'thousands' => '.',
	                            'decimals' => ',',
	                        )); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if ( $this->Session->read('Auth.User.user_type') == 'reseller' ): ?>
                    <tr>
                        <td colspan="4" class="subtotal"><?php __('Discount'); ?> <?php echo number_format($cartItem['Cart']['discount_pct'], 0); ?>%</td>
                        <td class="total">
                            <?php echo $this->Number->currency($cartItem['Cart']['sub_total'] - $cartItem['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                    </tr>
                    <tr class="col-subtotal">
                        <td colspan="4" class="subtotal"><?php __('Sub Total after discount'); ?></td>
                        <td class="total">
                            <?php echo $this->Number->currency($cartItem['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>