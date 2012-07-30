<p>Hi <?php echo $cart['User']['full_name']; ?>, we have received your request:</p>
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
        <tr>
            <td colspan="4">Shipping Costs</td>
            <td>
                <?php echo $this->Number->currency($cart['Cart']['shipping_costs'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">Total Price</td>
            <td>
                <?php echo $this->Number->currency($cart['Cart']['total_plus_shipping'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
            </td>
        </tr>
    </tbody>
</table>
<p>Transactions code: <?php echo $cart['Cart']['transactions_code'];?></p>
<br/>
<p>We will send your request to:</p>
<p>Name: <?php echo $cart['User']['full_name'];?></p>
<p>Address: <?php echo $cart['Cart']['shipping_address'];?></p>
<p>Phone: <?php echo $cart['Cart']['shipping_phone_number'];?></p>
<br/>
<p>Send your payment to:</p>
<?php $i = 0; ?>
<?php foreach($banks as $bank): ?>
    <p>Bank name: <?php echo $bank['Bank']['bank_name']; ?></p>
    <p>Account name: <?php echo $bank['Bank']['account_name']; ?></p>
    <p>Account no.: <?php echo $bank['Bank']['bankaccount_no']; ?></p>
    <?php if($i == 0): ?>
        <p>Or</p>
        <?php ($i++); ?>
    <?php endif; ?>
<?php endforeach; ?>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p>Administrator</p>
<br/>
<div>--</div>
<p>&copy; 2010 Gee*Eight All Right Reserved</p>