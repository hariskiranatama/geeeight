<div class="container">                             
     <div class="main-content store">
        <h1 class="title">Store Location</h1>
        <?php foreach($stores as $store) : ?>
        <div class="store-list">
            <h2 class="name"><?php echo ($store['Store']['store_name']); ?></h2>
            <div class="desc">
                <p class="jalan"><?php echo $store['Store']['store_address']; ?></p>
                <p class="kota"><?php echo $store['Store']['city']; ?></p>
                <p class="pos"><?php echo $store['Store']['zipcode']; ?></p>
                <p class="mail">
                    <a href="mailto:<?php echo $store['Store']['store_email']; ?>"><img src="<?php echo $this->webroot; ?>images/mail.png" alt="mail"><?php echo $store['Store']['store_email']; ?></a>
                </p>
                <p class="phone"><?php echo $store['Store']['store_phone']; ?></p>
            </div>
            <?php if ( $store['Store']['store_image'] ): ?>
                <div class="image">
                    <?php echo $this->MeioUpload->displayFile('store_image', array('data' => $store, 'label' => false, 'div' => false)); ?>
                </div>
            <?php endif; ?>                          
            <?php if ( $store['Store']['latitude'] != '' AND $store['Store']['longitude'] != '' ): ?>
                <div>
                    <?php echo $this->Form->hidden('latitude', array('name' => 'latitude', 'value' => $store['Store']['latitude'])); ?>
                    <?php echo $this->Form->hidden('longitude', array('name' => 'longitude', 'value' => $store['Store']['longitude'])); ?>
                    <div class="map map_canvas"><img src="<?php echo $this->webroot; ?>images/loading.gif" alt=""/> Loading map...</div>
                </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>
<!--  javascript -->
<script type="text/javascript">
var marker_icon = "<?php echo $this->webroot; ?>images/logo-g8.png";
</script>
<?php echo $html->script('http://maps.google.com/maps/api/js?sensor=false'); ?>
<?php echo $html->script('jquery/jquery.googleMaps'); ?>
<?php echo $html->script('app/stores_index'); ?>
