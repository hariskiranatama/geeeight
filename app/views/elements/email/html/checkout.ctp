<p>Hi Administrator, I have request for:</p>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cartItems as $cartItem): ?>
            <tr>
                <td>
                    <?php echo $cartItem['Item']['item_name']; ?>
                </td>
                <td>
                    <?php echo $cartItem['Item']['size_id']; ?>
                </td>
                <td>
                    <?php echo $this->Number->currency($cartItem['Item']['sales_price'], 'Rp. ', array (
                                'thousands' => '.',
                                'decimals' => ',',
                    )); ?>
                </td>
                <td>
                    <?php echo number_format($cartItem['CartItem']['qty']); ?>
                </td>
                <td>
                    <?php echo $this->Number->currency($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4">Sub Total</td>
            <td>
            <?php echo $this->Number->currency($cart['Cart']['sub_total'], 'Rp. ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>
            </td>
        </tr>
        <?php if ($cart['User']['user_type'] == 'reseller'): ?>
            <tr>
                <td colspan="4">Discount <?php echo number_format($cart['Cart']['discount_pct'], 0); ?>%</td>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['sub_total'] - $cart['Cart']['total_price'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Sub Total after discount</td>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['total_price'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<p>Transactions code: <?php echo $cart['Cart']['transactions_code'];?></p>
<br/>
<p>Shipping address:</p>
<p>Name: <?php echo $cart['User']['full_name'];?></p>
<p>Address: <?php echo $cart['Cart']['shipping_address'];?></p>
<p>Phone: <?php echo $cart['Cart']['shipping_phone_number'];?></p>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p><?php echo $cart['User']['full_name']; ?></p>
<br/>
<div>--</div>
<p>&copy; 2010 Gee*Eight All Right Reserved</p>