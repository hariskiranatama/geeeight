<p>Hi Administrator,</p>
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
        <?php foreach($cart as $cartItem): ?>
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
            <td>Sub Total</td>
            <td>
            </td>
        </tr>
        <tr>
            <td>Discount</td>
            <td>
            </td>
        </tr>
        <?php if ($user['User']['user_type'] == 'reseller'): ?>
            <tr>
                <td>Sub Total after discount</td>
                <td>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p><?php echo $user['User']['full_name']; ?></p>
<br/>
<div>--</div>
<p>&copy; 2010 Gee*Eight All Right Reserved</p>