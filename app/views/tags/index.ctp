<?php //debug($categories);?>
<?php $tag_image = $tag; ?>
<div class="container">
    <div class="left-menu">
        <h2><?php echo $tag['Tag']['name']; ?></h2>
        <?php if($categories): ?>
            <ul class="sub-category specials">
            <?php foreach($categories as $category): ?>
                <li><?php echo $this->Html->link($category['Category']['name'], array('admin' => false, 'controller' => 'categories', 'action' => 'index', $category['Category']['id'])); ?>
                    <ul>
                        <?php foreach($category['ItemType'] as $itemType): ?>
                            <li><?php echo $this->Html->link($itemType['type_name'], array('admin' => false, 'controller' => 'categories', 'action' => 'index', $category['Category']['id'], $itemType['type_id'])); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <br/><br/>
        <h2 class="tag"><?php __('Tags'); ?></h2>
        <ul class="tags">
            <?php foreach($tags as $tag): ?>
                <li>
                    <?php echo $this->Html->link($tag['Tag']['name'], array('admin' => false, 'controller' => 'tags', 'action' => 'index', $tag['Tag']['id'])); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="product">
        <?php
        $bannerImage = false;
        if ( ! $bannerImage ) {
            $bannerImage = $this->MeioUpload->displayFile('tag_image', array('data' => $tag_image, 'onlyURL' => true, 'default' => 'uploads/tag/image_file'));
        }
        ?>
        <div class="banner" style="background: url(<?php echo $bannerImage; ?>)"></div>
        <div class="gambar">
            <div class="nav-button">
                <a class="prev browse left<?php if ( count($itemsList) < 2 ): ?> disabled<?php endif; ?>"></a>
                <a class="next browse right<?php if ( count($itemsList) < 2 ): ?> disabled<?php endif; ?>"></a>
                <img class="loading right disabled" src="<?php echo $this->webroot; ?>images/loading.gif" alt="loading..." alt="loading next page" />
                <div class="navi"></div>
            </div>
            <div class="scrollable" id="browsable">
                <div class="items">
                <?php foreach ( $itemsList as $page => $items ): ?>
                    <?php if ( $items ): ?>
                    <ul class="thumb">
                        <?php foreach ( $items as $item ): ?>
                            <li>
                                <div class="gallery">
                                    <div class="item">
                                        <?php echo $this->Html->link(
                                            $this->MeioUpload->displayFile('image_file', array('fileData' => $item['Item'], 'label' => false, 'div' => false, 'thumbsize' => 'list', 'default' => 'uploads/item/image_file')),
                                            array('admin' => false, 'controller' => 'items', 'action' => 'view', $item['Item']['id']), array('escape' => false));
                                        ?>
                                    </div>
                                    <div class="desc">
                                        <?php echo $this->Html->link(
                                            $item['Item']['item_name'],
                                            array('admin' => false, 'controller' => 'items', 'action' => 'view', $item['Item']['id']), array('escape' => false));
                                        ?><br/>
                                        <?php echo $this->Number->currency($item['Item']['sales_price'], 'IDR ', array (
                                            'thousands' => '.',
                                            'decimals' => ',',
                                        )); ?><br/>
                                </div>
                           </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php echo $this->element('menu');?>
</div>
<?php
$url_param = $this->params['url'];
$page_from_url = 1;
if ( isset($url_param['url']) ) {
    unset($url_param['url']);
}
if ( isset($url_param['ext']) ) {
    unset($url_param['ext']);
}
if ( isset($url_param['page']) ) {
    $page_from_url = intval($url_param['page']);
    unset($url_param['page']);
}
?>
<script type="text/javascript">
    var this_page_url = "<?php echo $this->here.(count($url_param) > 0 ? '?'.http_build_query($url_param) : ''); ?>";
    var page_from_url = "<?php echo $page_from_url; ?>";
</script>
<?php echo $this->Html->script('app/scrollable'); ?>