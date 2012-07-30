<div class="banner vertical">
    <?php if ( isset($homescreen) AND $homescreen ): ?>
        <?php echo $this->MeioUpload->displayFile('image_file', array(
            'fileData' => $homescreen['WebsiteImage'],
            'thumbsize' => 'normal',
            'label' => false,
            'div' => false,
            'class' => 'ban',
            'alt' => 'background',
        )); ?>
    <?php else: ?>
        <img class="ban" src="<?php echo $this->webroot; ?>images/banner-vertical-bg.jpg" alt="background"/>
    <?php endif; ?>
    <div class="ver">
        <?php if ( isset($thumbnails) AND $thumbnails['portrait']['images'] ): ?>
            <?php foreach ( $thumbnails['portrait']['images'] as $index => $thumbnail ): ?>
                <?php $url = $thumbnail['WebsiteImage']['link_url'] ? $thumbnail['WebsiteImage']['link_url'] : '#'; ?>
                <div class="portrait">
                    <img class="new<?php if ( $thumbnail['WebsiteImage']['is_new'] != 1 ): ?> disabled<?php endif; ?>" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                    <div class="image">
                        <a href="<?php echo $url; ?>">
                            <?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $thumbnail['WebsiteImage'],
                                'thumbsize' => 'normal',
                                'label' => false,
                                'div' => false,
                                'alt' => $thumbnail['WebsiteImage']['title'],
                            )); ?>
                        </a>
                    </div>
                    <div class="text">
                        <h3><a href="<?php echo $url; ?>"><?php echo $thumbnail['WebsiteImage']['title']; ?></a></h3>
                        <a href="<?php echo $url; ?>">
                            <?php echo $thumbnail['WebsiteImage']['caption']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="portrait">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/arrivalv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">New Arrivals</a></h3>
                    <a href="#">
                        Hot new &amp; imited products <br/>EVERYDAY
                    </a>
                </div>
            </div>
            <div class="portrait">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/dressesv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">Dresses</a></h3>
                    <a href="#">
                        The newest must haves, featuring the Stretch Cotton
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( isset($thumbnails) AND $thumbnails['landscape']['images'] ): ?>
            <?php foreach ( $thumbnails['landscape']['images'] as $index => $thumbnail ): ?>
                <?php $url = $thumbnail['WebsiteImage']['link_url'] ? $thumbnail['WebsiteImage']['link_url'] : '#'; ?>
                <div class="landscape">
                    <img class="new<?php if ( $thumbnail['WebsiteImage']['is_new'] != 1 ): ?> disabled<?php endif; ?>" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                    <div class="image">
                        <a href="<?php echo $url; ?>">
                            <?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $thumbnail['WebsiteImage'],
                                'thumbsize' => 'normal',
                                'label' => false,
                                'div' => false,
                                'alt' => $thumbnail['WebsiteImage']['title'],
                            )); ?>
                        </a>
                    </div>
                    <div class="text">
                        <h3><a href="<?php echo $url; ?>"><?php echo $thumbnail['WebsiteImage']['title']; ?></a></h3>
                        <a href="<?php echo $url; ?>">
                            <?php echo $thumbnail['WebsiteImage']['caption']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="landscape">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/topsv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">Tops</a></h3>
                    <a href="#">
                        The newest must haves, featuring the Stretch Cotton
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( isset($thumbnails) AND $thumbnails['portrait2']['images'] ): ?>
            <?php foreach ( $thumbnails['portrait2']['images'] as $index => $thumbnail ): ?>
                <?php $url = $thumbnail['WebsiteImage']['link_url'] ? $thumbnail['WebsiteImage']['link_url'] : '#'; ?>
                <div class="portrait">
                    <img class="new<?php if ( $thumbnail['WebsiteImage']['is_new'] != 1 ): ?> disabled<?php endif; ?>" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                    <div class="image">
                        <a href="<?php echo $url; ?>">
                            <?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $thumbnail['WebsiteImage'],
                                'thumbsize' => 'normal',
                                'label' => false,
                                'div' => false,
                                'alt' => $thumbnail['WebsiteImage']['title'],
                            )); ?>
                        </a>
                    </div>
                    <div class="text">
                        <h3><a href="<?php echo $url; ?>"><?php echo $thumbnail['WebsiteImage']['title']; ?></a></h3>
                        <a href="<?php echo $url; ?>">
                            <?php echo $thumbnail['WebsiteImage']['caption']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="portrait">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/jacketsv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">Jackets</a></h3>
                    <a href="#">
                        The newest must haves, featuring the Stretch Cotton
                    </a>
                </div>
            </div>
            <div class="portrait">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/bottomsv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">Bottoms</a></h3>
                    <a href="#">
                        The newest must haves, featuring the Stretch Cotton
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( isset($thumbnails) AND $thumbnails['landscape2']['images'] ): ?>
            <?php foreach ( $thumbnails['landscape2']['images'] as $index => $thumbnail ): ?>
                <?php $url = $thumbnail['WebsiteImage']['link_url'] ? $thumbnail['WebsiteImage']['link_url'] : '#'; ?>
                <div class="landscape">
                    <img class="new<?php if ( $thumbnail['WebsiteImage']['is_new'] != 1 ): ?> disabled<?php endif; ?>" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                    <div class="image">
                        <a href="<?php echo $url; ?>">
                            <?php echo $this->MeioUpload->displayFile('image_file', array(
                                'fileData' => $thumbnail['WebsiteImage'],
                                'thumbsize' => 'normal',
                                'label' => false,
                                'div' => false,
                                'alt' => $thumbnail['WebsiteImage']['title'],
                            )); ?>
                        </a>
                    </div>
                    <div class="text">
                        <h3><a href="<?php echo $url; ?>"><?php echo $thumbnail['WebsiteImage']['title']; ?></a></h3>
                        <a href="<?php echo $url; ?>">
                            <?php echo $thumbnail['WebsiteImage']['caption']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="landscape">
                <img class="new" src="<?php echo $this->webroot; ?>images/new.png" alt="new"/>
                <div class="image">
                    <a href="#">
                        <img src="<?php echo $this->webroot; ?>images/bagsv.jpg" alt="dress"/>
                    </a>
                </div>
                <div class="text">
                    <h3><a href="#">Bags</a></h3>
                    <a href="#">
                        The newest must haves, featuring the Stretch Cotton
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
<?php echo $this->element('menu'); ?>
<div class="container">
    <div class="main-content home">
        <?php echo $this->element('events_in_front'); ?>
        <?php echo $this->element('polls_in_front'); ?>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>