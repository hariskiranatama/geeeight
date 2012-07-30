<div class="stores view">
<h2><?php  __d("admin", 'Store Detail');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Posted By'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($store['User']['full_name'], array('controller' => 'users', 'action' => 'view', $store['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Store Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['store_name']; ?>
            &nbsp;
        </dd>
        <?php if ( $store['Store']['store_image'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Store Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->MeioUpload->displayFile('store_image', array('data' => $store, 'label' => false, 'div' => false)); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Store Address'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['store_address']; ?>
            <?php echo ' ' . $store['Store']['city']; ?>
            <?php echo ' ' . $store['Store']['zipcode']; ?>
            <?php echo ' ' . $store['Store']['country']; ?>
            &nbsp;
        </dd>
        <?php if ( $store['Store']['latitude'] != '' AND $store['Store']['longitude'] != '' ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Google Map'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->Form->hidden('latitude', array('value' => $store['Store']['latitude'], 'id' => 'StoreLatitude')); ?>
                <?php echo $this->Form->hidden('longitude', array('value' => $store['Store']['longitude'], 'id' => 'StoreLongitude')); ?>
                <div id="map_canvas"><img src="<?php echo $this->webroot; ?>images/loading.gif" alt=""/> Loading map...</div>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Store Phone'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['store_phone']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Store Email'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['store_email']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $store['Store']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
		<li><?php echo $this->Html->link(__d("admin", 'Edit Store', true), array('action' => 'edit', $store['Store']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'Delete Store', true), array('action' => 'delete', $store['Store']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this store?', true), $store['Store']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'List Stores', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'New Store', true), array('action' => 'add')); ?> </li>
    </ul>
</div>
<!--  javascript -->
<script type="text/javascript">
var marker_icon = "<?php echo $this->webroot; ?>images/logo-g8.png";
</script>
<?php echo $html->script('http://maps.google.com/maps/api/js?sensor=false'); ?>
<?php echo $html->script('jquery/jquery.googleMaps'); ?>
<?php echo $html->script('app/stores_admin_view'); ?>