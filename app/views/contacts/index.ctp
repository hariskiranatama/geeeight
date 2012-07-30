<div class="container"> 
    <div class="left-menu">
        <h2><?php __('customer services'); ?></h2>
    </div>
     <div class="main-content submit-form contact">
        <h1 class="title"><?php __('Contact Us'); ?></h1>
        <div>
            <h3><?php __('Customer care Center'); ?></h3>
            <div class="by-phone">
                <p class="contact-name"><?php __('Office'); ?></p>
                <p>Jl. Progo No.3 <br/>Bandung, West Java <br/>Indonesia </p>
                <p>Phone: +6222 4267686 <br/>e-Mail : info@geeeight.com </p>
            </div>
            <div class="by-phone">
                <p class="contact-name">Erik Firmansyah (<?php __('Wholesale'); ?>)</p>
                <p>Phone: +62 8156002741 <br/>
                <?php __('Mail'); ?>: erik.firmansyah@geeeight.com </p>
            </div>            
            <div class="by-phone">
                <p class="contact-name">Agus Sukaryat (<?php __('On Line Sales'); ?>)</p>
                <p>Phone: +6222 91910798, +62 83822707520 <br/>
                <?php __('Mail'); ?>: agus.sukaryat@geeeight.com</p>
            </div>
            <div class="by-phone">
                <p class="contact-name">Alifia Meta (<?php __('Promotion'); ?>)</p>
                <p>Phone: +62 85624049287 <br/>
                <?php __('Mail'); ?>: alifia.meta@geeeight.com </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-1">
        <h3><?php __('Contact Information'); ?></h3>
        <p><?php __('Please fill the information below, our customer representative will contact you back.'); ?></p>
            <?php echo $this->Form->create('Contact', array(
                'admin' => false,
                'controller' => 'contacts',
                'action' => 'index',
                'inputDefaults' => array(
                    'between' => '<div class="textfield">',
                    'after' => '</div>',
                    'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                )
            ));?>
                <?php echo $this->Form->input('name', array('label' => __('Name', true))); ?>
                <?php echo $this->Form->input('email_address', array('label' => __('Email Address', true))); ?>
                <?php echo $this->Form->input('contact_subject_id', array(
                    'label' => __('Subject', true),
                    'options' => $subjectOptions,
                    'class' => 'input select',
                    'between' => '<div class ="combobox">',
                    'after' => '</div>'
                )); ?>
                <?php echo $this->Form->input('message', array(
                    'label' => __('Message', true),
                    'between' => '<div class="text-area">',
                    'after' => '</div>',
                )); ?>
                <?php $recaptcha->display_form('echo'); ?>
                <p class="required-field">&#42;<?php __('Required Field'); ?></p>
                <input type="image" src="<?php echo $this->webroot; ?>images/submit.png" />
            <?php echo $this->Form->end(); ?>
        </div>                    
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>
