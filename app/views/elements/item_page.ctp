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
                    <?php echo $this->Number->currency($item['Item']['sales_price'], '', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?><br/>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>