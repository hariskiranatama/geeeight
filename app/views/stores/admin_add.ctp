<div class="stores form">
    <?php echo $this->Form->create('Store', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add New Store'); ?></legend>
        <?php echo $this->Form->input('store_name', array('label' => 'Name')); ?>
        <?php echo $this->Form->input('store_address', array('label' => 'Address')); ?>
        <?php echo $this->Form->input('city'); ?>
        <?php echo $this->Form->input('country'); ?>
        <?php echo $this->Form->input('zipcode'); ?>
        <?php echo $this->Form->input('store_phone', array('label' => 'Phone')); ?>
        <?php echo $this->Form->input('store_email', array('label' => 'Email')); ?>
        <?php echo $this->Form->input('store_image', array('label' => 'Store Image (230x300)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('latitude'); ?>
        <?php echo $this->Form->input('longitude'); ?>
        <a href="#" id="removeMap">Remove Map Marker</a><br/>
        <div id="map_canvas"><img src="<?php echo $this->webroot; ?>images/loading.gif" alt=""/> Loading map...</div>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'stores', 'action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Stores', true), array('action' => 'index')); ?></li>
    </ul>
</div>
<!--  javascript -->
<script type="text/javascript">
var marker_icon = "<?php echo $this->webroot; ?>images/logo-g8.png";
</script>
<?php echo $html->script('http://maps.google.com/maps/api/js?sensor=false'); ?>
<?php echo $html->script('ckeditor/ckeditor'); ?>
<?php echo $html->script('jquery/jquery.googleMaps'); ?>
<?php echo $html->script('app/stores_admin_add'); ?>