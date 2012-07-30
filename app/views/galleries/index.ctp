<div class="container">
    <div class="left-menu">
        <h2><?php __('Gallery');?></h2>
        <ul class="sub-category">
            <?php foreach($albums as $album): ?>
                <li>
                    <?php echo $this->Html->link($album['Album']['album_name'], array('controller' => 'galleries', 'action' => 'index', $album['Album']['id'])); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="main-content gallery-page">
        <h1 class="title"><?php echo ucwords($currentAlbum); ?></h1>
        <?php if ($albumDescription): ?>
            <h4><?php echo $albumDescription['Album']['description']?></h4>
        <?php endif; ?>
        <h5><?php echo date('l, d F Y'); ?></h5>
        <div class="gambar">
            <div class="nav-button">
                <a class="prev browse left<?php if ( count($albumsList) < 2 ): ?> disabled<?php endif; ?>"></a>
                <a class="next browse right<?php if ( count($albumsList) < 2 ): ?> disabled<?php endif; ?>"></a>
                <div class="navi"></div>
            </div>
            <div class="scrollable" id="browsable">
                <div class="items">
                    <?php foreach ( $albumsList as $page => $galleries ): ?>
                        <?php if ( $galleries ): ?>
                            <ul class="thumbnail">
                                <?php foreach ($galleries as $gallery): ?>
                                    <li>
                                        <div class="gallery">
                                            <div class="item">
                                                <?php echo $this->MeioUpload->displayFile('gallery_image', array(
                                                    'fileData' => $gallery['Gallery'],
                                                    'thumbsize' => 'list',
                                                    'thumbsize_link' => 'normal',
                                                    'label' => false,
                                                    'div' => false,
                                                    'default' => 'uploads/item/image_file'
                                                )); ?>
                                            </div>
                                            <div class="desc">
                                                <?php echo $gallery['Gallery']['description']?><br/>
                                                <?php echo $gallery['Gallery']['photographer']?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="clear"></div>
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
    var page_from_url = parseInt("<?php echo $page_from_url; ?>", 10);
</script>
<?php echo $this->Html->script('app/scrollable'); ?>
<?php echo $this->Html->script('app/lightbox'); ?>