<div class="container">             
    <div class="left-menu right">
        <h2><?php __("what it's in my cart"); ?></h2>
    </div>
     <div class="main-content submit-form cart transaction">
        <h1 class="title"><?php __('Check Out'); ?></h1><hr/><br/>
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
                <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
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
                        <?php echo $this->Number->currency($cartData['Cart']['sub_total'], 'Rp. ', array (
                            'thousands' => '.',
                            'decimals' => ',',
                        )); ?>
                    </td>
                </tr>
                <?php if ( $this->Session->read('Auth.User.user_type') == 'reseller' ): ?>
                    <tr>
                        <td colspan="4" class="subtotal"><?php __('Discount'); ?> <?php echo number_format($cartData['Cart']['discount_pct'], 0); ?>%</td>
                        <td class="total">
                            <?php echo $this->Number->currency($cartData['Cart']['sub_total'] - $cartData['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                    </tr>
                    <tr class="col-subtotal">
                        <td colspan="4" class="subtotal"><?php __('Sub Total after discount'); ?></td>
                        <td class="total">
                            <?php echo $this->Number->currency($cartData['Cart']['total_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                            )); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php echo $this->Form->create(null, array(
            'url' => array(
                'controller' => 'carts',
                'action' => 'checkout',
                ),
            'id' => 'cartForm',
            'inputDefaults' => array(
                'between' => '<div class="textfield">',
                'after' => '</div>',
                'format' => array('before', 'between', 'input', 'after', 'error'),
                ),
        )); ?>
            <div class="shipping">
                <h2><?php __('Shipping address'); ?></h2>
                <div>
                    <label><?php __('Name'); ?></label>
                    <div class="textfield"><input type="text" readonly="readonly" value="<?php echo $this->Session->read('Auth.User.full_name'); ?>"/></div>
                </div>
                <div>
                    <label><?php __('Email'); ?></label>
                    <div class="textfield"><input type="text" readonly="readonly" value="<?php echo $this->Session->read('Auth.User.email_address'); ?>"/></div>
                </div>
                <div class="shipping-list">
                    <label><?php __('Address &amp; Phone'); ?></label>
                    <?php foreach($addresses as $address): ?>
                        <div class="address-detail">
                            <input type="radio" name="address" value="<?php echo $address['Address']['id']; ?>"/>
                            <div class="text-area"><textarea readonly="readonly" ><?php echo $address['Address']['address']; ?></textarea></div>
                            <div class="textfield"><input type="text" readonly="readonly" value="<?php echo $address['Address']['phone_number']; ?>"/></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="address-detail last">
                        <input type="radio" name="address" value="-1"/>
                        <?php echo $this->Form->input('Address.user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'))); ?>
                        <?php echo $this->Form->input('Address.address', array(
                            'label' => false,
                            'div' => false,
                            'between' => '<div class="text-area">',
                            'after' => '</div>',
                        )); ?>
                        <?php echo $this->Form->input('Address.phone_number', array('div' => false, 'label' => false)); ?>
                    </div>
                </div>
            </div>
            <input type="image" src="<?php echo $this->webroot; ?>images/process.png" />
        <?php echo $this->Form->end(); ?>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>