<div class="container">
    <div class="left-menu">
        <h2><?php __('email to friend'); ?></h2>
    </div>
     <div class="main-content submit-form mail-to-friend">
        <h1 class="title"><?php echo $item_name['Item']['item_name'] . __(' of Gee*Eight', true)?></h1>
        <div class="col-1">
            <?php echo $this->Form->create('EmailToFriend', array(
                'url' => array(
                    'controller' => 'items',
                    'action' => 'email',
                    ),
                'inputDefaults' => array(
                        'between' => '<div class="textfield">',
                        'after' => '</div>',
                        'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                ),
            )); ?>
            <?php echo $this->Form->input('friendname', array('label' => __('Friend Name', true))); ?>
            <?php echo $this->Form->input('friendemail', array('label' => __('Email Address', true))); ?>
            <?php echo $this->Form->input('message', array(
                'type' => 'textarea',
                'label' => __('Message', true),
                'between' => '<div class="text-area">',
                'after' => '</div>',
            )); ?>
            <?php echo $this->Form->hidden('itemId', array('value' => $id)); ?>
            <p class="required-field">&#42;<?php __('Required Field'); ?></p>
            <input type="image" src="<?php echo $this->webroot; ?>images/submit.png" />
            <?php echo $this->Form->end(); ?>
        </div>                    
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>