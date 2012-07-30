<div class="container">
    <div class="left-menu">
        <h2><?php echo $category['Category']['name']; ?></h2>
        <ul class="sub-category">
            <?php foreach($itemTypes as $itemType):?>
                <li><?php echo $html->link($itemType['ItemType']['type_name'], array('admin' => false, 'controller' => 'categories', 'action' => 'index', $itemType['Category']['id'], $itemType['ItemType']['type_id'])); ?></li>
            <?php endforeach; ?>
        </ul>
        <br/><br/>
        <h2 class="tag"><?php __('Tags'); ?></h2>
        <ul class="tags">
            <?php foreach($item['Tag'] as $tag): ?>
                <li>
                    <?php echo $html->link($tag['name'], array('admin' => false, 'controller' => 'tags', 'action' => 'index', $tag['id'])); ?>    
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="product">
        <div class="product-detail">
            <div class="gambar">
                <div class="main-image">
                    <?php echo $this->MeioUpload->displayFile('image_file', array(
                        'fileData' => $item['Item'],
                        'label' => false,
                        'div' => false,
                        'default' => 'uploads/item/image_file'
                    )); ?>
                </div>
                <ul>
                    <li>
                        <?php echo $this->MeioUpload->displayFile('image_file', array(
                            'fileData' => $item['Item'],
                            'thumbsize' => 'small',
                            'thumbsize_link' => 'normal',
                            'label' => false,
                            'div' => false,
                            'default' => 'uploads/item/image_file'
                        )); ?>
                    </li>
                    <?php foreach($item['ItemImage'] as $item_image): ?>
                        <?php if ( $item_image['is_material'] == 0 ): ?>
                            <li>
                                <?php echo $this->MeioUpload->displayFile('image_file', array(
                                    'fileData' => $item_image,
                                    'thumbsize' => 'small',
                                    'thumbsize_link' => 'normal',
                                    'label' => false,
                                    'div' => false,
                                    'default' => 'uploads/item_image/image_file'
                                )); ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="desc">
                <h2 class="title"><?php echo $item['Item']['item_name']; ?></h2>
                <div class="desc-item">
                    <p><?php echo $item['Item']['description']; ?></p>
                    <p><a href="javascript:popUp('/images/size_chart_g8.gif')">Size chart</a></p>
                    <p><?php __('Stock')?>:&nbsp;<?php echo ($item['Item']['actual_stock'] == null) ? 0 : $item['Item']['actual_stock']; ?></p>
                    <div class="harga">
                        <?php echo $this->Number->currency($item['Item']['sales_price'], 'IDR ', array (
                            'thousands' => '.',
                            'decimals' => ',',
                        )); ?>
                    </div>
                </div>
                <div>
                    <ul class="bahan">
                    <?php foreach($item['ItemImage'] as $item_image): ?>
                        <?php if ( $item_image['is_material'] == 1 ): ?>
                            <li><?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $item_image,
                                'thumbsize' => 'material',
                                'thumbsize_link' => 'normal',
                                'label' => false,
                                'div' => false,
                                'default' => 'uploads/item_image/image_file'
                            )); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="share">
                    <div class="mail-to-friends">
                        <?php echo $html->link(null, array('admin' => false, 'controller' => 'items', 'action' => 'email', $item['Item']['id']), array('title' => 'share via mail'));?>
                    </div>
                    <div class="addthis_toolbox addthis_32x32_style addthis_default_style">
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_twitter"></a>
                        <a class="addthis_button_compact"></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php echo $this->Form->create('Item', array('admin' => false, 'url' => array('controller' => 'items', 'action' => 'buy', $item['Item']['id']))); ?>
                    <div class="pilihan">
                        <?php echo $this->Form->input('id', array(
                            'label' => false,
                            'options' => $sizes,
                            'selected' => $item['Item']['id'],
                            'div' => false,
                        )); ?>
                        <?php echo $this->Form->input('qty', array(
                            'label' => false,
                            'name' => 'qty',
                            'options' => $qty,
                            'empty' => 'Quantity',
                            'div' => false,
                        ));?>
                    </div>
                    <?php //<a href="#">add more at a time</a> ?>
                    <br/>
                    <br/>
                    <input type="image" src="<?php echo $this->webroot; ?>images/cart-button.png"/>
                <?php echo $this->Form->end(); ?>
            </div>
            <div class="clear"></div>                       
        </div>
        <?php if ($recomends): ?>
            <div class="recomended">
                <h1><?php __('We Also Recomend')?></h1>
                <?php foreach($recomends as $recomend): ?>
                    <div class="item">
                        <div class="gambar">
                            <?php echo $html->link(
                                $this->MeioUpload->displayFile('image_file', array(
                                    'fileData' => $recomend['Recomend'],
                                    'thumbsize' => 'medium',
                                    'label' => false,
                                    'div' => false,
                                    'default' => 'uploads/item/image_file'
                                )),
                                array('admin' => false, 'controller' => 'items', 'action' => 'view', $recomend['Recomend']['id']), array('escape' => false));
                            ?>
                        </div>
                        <div class="desc">
                            <h3 class="title"><?php echo $recomend['Recomend']['item_name']; ?></h3>
                            <div class="desc-item">
                                <p><?php echo $recomend['Recomend']['description']; ?></p>
                                <p><?php __('Stock')?>:&nbsp;<?php echo ($recomend['Recomend']['actual_stock'] == null) ? 0 : $recomend['Recomend']['actual_stock']; ?></p>
                                <div class="harga">
                                    <?php echo $this->Number->currency($recomend['Recomend']['sales_price'], 'IDR ', array (
                                        'thousands' => '.',
                                        'decimals' => ',',
                                    )); ?>
                                </div>
                            </div>
                        </div>
                        <div class="choice">
                            <div>
                                <ul class="bahan">
                                    <?php foreach($recomend['Recomend']['ItemImage'] as $item_image): ?>
                                        <?php if ( $item_image['is_material'] == 1 AND $item_image['image_file'] ): ?>
                                            <li><?php echo $this->MeioUpload->displayFile('image_file', array(
                                                'fileData' => $item_image,
                                                'thumbsize' => 'material',
                                                'label' => false,
                                                'div' => false
                                            )); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="share">
                                <div class="mail-to-friends">
                                    <?php echo $html->link(null, array('admin' => false, 'controller' => 'items', 'action' => 'email', $recomend['Recomend']['id']), array('title' => 'share via mail'));?>
                                </div>
                                <div class="addthis_toolbox addthis_32x32_style addthis_default_style" addthis:url="<?php echo sprintf($html->url(array('admin' => false, 'controller' => 'items', 'action' => 'view', $recomend['Recomend']['id']), true), null); ?>" addthis:title="<?php echo $recomend['Recomend']['item_name'] . __(' of Gee*Eight', true); ?>" addthis:description="<?php echo $this->Text->truncate(strip_tags($recomend['Recomend']['description']), 255, array('ending' => '...', 'exact' => false)); ?>">
                                    <a class="addthis_button_facebook"></a>
                                    <a class="addthis_button_twitter"></a>
                                    <a class="addthis_button_compact"></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?php echo $this->Form->create('Item', array('admin' => false, 'url' => array('controller' => 'items', 'action' => 'buy', $recomend['Recomend']['id'])));?>
                                <div class="pilihan">
                                    <?php echo $this->Form->input('id', array(
                                        'label' => false,
                                        'options' => $recomend_sizes,
                                        'selected' => $recomend['Recomend']['id'],
                                        'div' => false,
                                    )); ?>
                                    <?php echo $this->Form->input('qty', array(
                                        'label' => false,
                                        'name' => 'qty',
                                        'options' => $qty,
                                        'empty' => 'Quantity',
                                        'div' => false,
                                    ));?>
                                    <br/>
                                    <?php //<a href="#">add more at a time</a> ?>
                                    <br/>
                                    <br/>
                                    <input type="image" src="<?php echo $this->webroot; ?>images/cart-button.png"/>
                                </div>
                            <?php echo $this->Form->end(); ?>
                        </div>                      
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php echo $this->element('menu');?>
<script type="text/javascript" src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php echo $this->Html->script('app/item_view'); ?>
<?php echo $this->Html->script('app/item_sizes'); ?>