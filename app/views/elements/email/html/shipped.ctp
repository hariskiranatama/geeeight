<p>Hi <?php echo $cart['User']['full_name']; ?>, we have shipped your request:</p>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Size</th>
            <th>Quantity</th>
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
                    <?php echo number_format($cartItem['CartItem']['qty']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Transactions code: <?php echo $cart['Cart']['transactions_code'];?></p>
<p>Postal Service Company: <?php echo $cart['Cart']['postal_service'];?></p>
<p>Tracking Number: <?php echo $cart['Cart']['tracking_number'];?></p>
<br/>
<p>We have send your request to:</p>
<p>Name: <?php echo $cart['User']['full_name'];?></p>
<p>Address: <?php echo $cart['Cart']['shipping_address'];?></p>
<p>Phone: <?php echo $cart['Cart']['shipping_phone_number'];?></p>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p>Administrator</p>
<br/>
<div>--</div>
<p>&copy; 2010 Gee*Eight All Right Reserved</p>