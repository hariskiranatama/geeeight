<div class="container">         
    <div class="left-menu right">
        <h2><?php __('your account'); ?></h2>
    </div>
     <div class="main-content submit-form profile">
        <h1 class="title"><?php __('My Account'); ?></h1>
        <div class="col-1">
            <h2><?php __('My Profile'); ?></h2>
            <?php echo $this->Form->create('User', array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'profile',
                'inputDefaults' => array(
                    'between' => '<div class="textfield">',
                    'after' => '</div>',
                    'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                )
            )); ?>
            <?php echo $this->Form->input('username', array('label' => __('Username', true), 'readonly' => true)); ?>
            <?php echo $this->Form->input('passwd', array('label' => __('New Password', true), 'type' => 'password', 'autocomplete' => 'off')); ?>
            <?php echo $this->Form->input('passwd_confirmation', array('label' => __('Password Confirmation', true), 'type' => 'password', 'autocomplete' => 'off')); ?>
            <?php echo $this->Form->input('email_address', array('label' => __('Email Address', true))); ?>
            <?php echo $this->Form->input('full_name', array('label' => __('Full Name', true))); ?>
            <?php echo $this->Form->input('address', array(
                'label' => __('Address', true),
                'between' => '<div class="text-area">',
                'after' => '</div>',
            )); ?>
            <?php echo $this->Form->input('phone_number', array('label' => __('Phone Number', true))); ?>
            <?php echo $this->Form->input('newsletter', array (
                'class' => 'styled',
                'label' => __('Join Newsletter', true),
                'type' => 'checkbox',
                'between' => null,
                'after' => null,
                'format' => array('before', 'input', 'between', 'label', 'after', 'error'),
            )); ?>
            <div>
                <input type="image" src="<?php echo $this->webroot; ?>images/save.png" />
                <?php echo $this->Html->link(null, array('admin' => false, 'controller' => 'pages', 'action' => 'index'), array('class' => 'but-continue', 'title' => __('continue shopping', true))); ?>
            </div>
            <?php echo $this->Form->end();?>
        </div>
        <div class="col-2 shopping">
            <h2><?php __('My Shopping Activity'); ?></h2>
            <?php if (! $carts): ?>
                <p><?php __('No shopping activity'); ?>!</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th class="id-trans"><?php __('Transaction Id'); ?></th>
                            <th class="date"><?php __('Transaction Date'); ?></th>
                            <th class="status"><?php __('Status'); ?></th>
                            <th class="qty"><?php __('Items Quantity'); ?></th>
                            <th class="total"><?php __('Total'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($carts as $cart): ?>
                            <tr>
                                <td class="id-trans">
                                    <?php echo $this->Html->link(__('Transaction', true) . ' ' . $cart['Cart']['id'], array(
                                        'controller' => 'carts',
                                        'action' => 'summary',
                                        $cart['Cart']['id']
                                        ),
                                        array('title' => __('view detail transaksi', true) . ' ' . $cart['Cart']['id'])
                                    ); ?>
                                </td>
                                <td class="date"><?php echo date('d/m/Y', strtotime($cart['Cart']['invoice_date'])); ?></td>
                                <td class="status"><?php echo $cart['Cart']['status']; ?></td>
                                <td class="qty">
                                    <?php $qty = 0; ?>
                                    <?php foreach($cart['CartItem'] as $cartitem): ?>
                                        <?php $qty = $qty + $cartitem['qty'];?>
                                    <?php endforeach; ?>
                                    <?php echo $qty; ?>
                                </td>
                                <td class="total">
                                    <?php echo $this->Number->currency($cart['Cart']['total_price'], 'Rp. ', array (
                                        'thousands' => '.',
                                        'decimals' => ',',
                                    )); ?>        
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <p class="required-field"><?php __('Click transaction id to view detail'); ?></p>
            <p><a href="http://www.jne.co.id/index.php?mib=tracking&lang=IN" target="_blank"><img src="/images/jne.png"></a></p>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>