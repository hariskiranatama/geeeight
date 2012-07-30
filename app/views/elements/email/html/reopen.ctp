<p>Hi <?php echo $cart['User']['full_name']; ?>, we have received your request, but the product that you requested is empty or insufficient.</p>
<p>We have re-open your transaction, please! update your shopping cart.</p>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity Requested</th>
            <th>Stock Available</th>
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
                    <?php echo $cartItem['Item']['actual_stock']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p>Administrator</p>
<br/>
<div>--</div>
<p>&copy; 2010 Gee*Eight All Right Reserved</p>