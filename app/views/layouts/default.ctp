<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo (isset($title_for_layout) AND $title_for_layout) ? $title_for_layout : 'Gee*Eight.com'; ?></title>
        <meta name="title" content="<?php echo (isset($title_for_layout) AND $title_for_layout) ? $title_for_layout : 'Gee*Eight.com'; ?>" />
        <meta name="description" content="<?php echo (isset($description_for_layout) AND $description_for_layout) ? $description_for_layout : 'House of Gee*eight'; ?>" />
        <meta name="keywords" content="Pakaian Wanita, Butik Online, Busana Wanita, Toko Baju Online, Jual Baju, Baju Terbaru, Baju Wanita Indonesia, Toko Pakaian Wanita, Jacket & Coat, Distro & Clothing Online, Baju Muslim, Female Store, Fashion Online Store Indonesia, Grosir Baju Online, Pesan Dress, Tas Wanita, Butik Baju Online, Hijab Clothing" />
        <?php if(isset($item['Item']['image_file']) AND $item['Item']['image_file']): ?>
        <link href="<?php echo 'http://geeeight.com' . $this->MeioUpload->displayFile('image_file', array('fileData' => $item['Item'], 'thumbsize' => 'socialnetwork', 'onlyURL' => true)); ?>" rel="image_src"/>
        <?php foreach($item['ItemImage'] as $item_image): ?>
        <link href="<?php echo 'http://geeeight.com' . $this->MeioUpload->displayFile('image_file', array('fileData' => $item_image, 'thumbsize' => 'socialnetwork', 'onlyURL' => true)); ?>" rel="image_src"/>
        <?php endforeach; ?>
        <?php elseif(isset($event['Event']['event_image'])): ?>
        <link href="<?php echo 'http://geeeight.com' . $this->MeioUpload->displayFile('event_image', array('data' => $event, 'thumbsize' => 'socialnetwork', 'onlyURL' => true)); ?>" rel="image_src"/>
        <?php endif; ?>
        <link href="<?php echo $this->webroot; ?>images/logo.png" rel="image_src"/>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('css.php?url=style.css');
        echo $this->Html->css('dd');
        echo $this->Html->css('prettyCheckboxes');
        if ( isset($additional_css) AND is_array($additional_css) ) {
            foreach ( $additional_css as $css_file ) {
                echo $this->Html->css($css_file);
            }
        }
        ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20982632-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script language="JavaScript">
<!-- Idea by:  Nic Wolfe -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=550,height=625,left = 0,top = 0');");
}
// End -->
</script>


    </head>
    <body>
        <div class="allcontainer">
        <div id="header">
            <div class="container">
                <div class="logo">
                    <a href="/"><img src="<?php echo $this->webroot; ?>images/logo.png" alt="logo"/></a>
                </div>
                <div class="lang-search">
                    <div class="lang">
                        <?php
                        $language = $this->Session->read('Config.language');
                        if ( ! $language ) {
                            $language = 'ind';
                        }
                        $url_param = $this->params['url'];
                        unset($url_param['url']);
                        unset($url_param['ext']);
                        if ( isset($url_param['lang']) ) {
                            unset($url_param['lang']);
                        }
                        ?>
                        <form method="get" action="#" id="lang_form"><fieldset>
                        <label for="lang"><?php __('Language')?>:</label>
                        <select id="lang" name="lang" >
                            <option class="id" value="ind" title="<?php echo $this->webroot; ?>images/id.png"<?php echo $language == 'ind' ? ' selected="selected"' : ''; ?>>Indonesia</option>
                            <option class="en" value="eng" title="<?php echo $this->webroot; ?>images/en.png"<?php echo $language == 'eng' ? ' selected="selected"' : ''; ?>>English</option>
                        </select>
                        <?php foreach ( $url_param as $name => $value ): ?>
                            <?php if ( is_array( $value )): ?>
                                <?php foreach ( $value as $key => $val ): ?>
                                    <input type="hidden" name="<?php echo $name; ?>[<?php echo $key; ?>]" value="<?php echo $val; ?>"/>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </fieldset></form>
                    </div>
                    <div class="cart-search">
                        <div class="cart">
                            <?php echo $this->Html->link(__('Shopping bag', true), array('admin' => false, 'controller' => 'carts', 'action' => 'index'), array('class' => 'cart')); ?>
                        </div>
                        <?php echo $this->Form->create('Item', array('type' => 'get', 'class' => 'search', 'controller' => 'items', 'action' => 'search'));?>
                            <fieldset>
                                <input class="search-header tip" type="text" title="<?php __('search')?>..." name="search" value="" size="20" maxlength="256"/>
                                <input type="image" src="<?php echo $this->webroot; ?>images/button-search.png" alt="search"/>
                            </fieldset>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
                <div class="login">
                    <ul>
                    <?php if ( $this->Session->read('Auth.User.username') ): ?>
                        <li><?php echo $this->Html->link(__('Logout', true),
                                       array('admin' => false, 'controller' => 'users', 'action' => 'logout'),
                                       array('class' => 'first')); ?></li>
                        <li><?php echo $this->Html->link(__('My Account', true),
                                       array('admin' => false, 'controller' => 'users', 'action' => 'profile'),
                                       array('class' => null)); ?></li>
                    <?php else: ?>
                        <li><?php echo $this->Html->link(__('Sign In', true),
                                       array('admin' => false, 'controller' => 'users', 'action' => 'login'),
                                       array('class' => 'first')); ?></li>
                        <li><?php echo $this->Html->link(__('Sign Up', true),
                                       array('admin' => false, 'controller' => 'users', 'action' => 'register'),
                                       array('class' => null)); ?></li>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <div class="container">
                <ul>
                    <li><?php echo $this->Html->link(__('New Arrivals', true), array('admin' => false, 'controller' => 'tags', 'action' => 'index', 1)); ?></li>
                    <?php foreach ($topMenuCategories as $topMenuCategory): ?>
                        <li><?php echo $this->Html->link($topMenuCategory['Category']['name'], array('admin' => false, 'controller' => 'categories', 'action' => 'index', $topMenuCategory['Category']['id'])); ?></li>
                    <?php endforeach; ?>
                    <li><?php echo $this->Html->link(__('Kids', true), array('admin' => false, 'controller' => 'tags', 'action' => 'index', 2)); ?></li>
                    <li><?php echo $this->Html->link(__('Upcoming', true), array('admin' => false, 'controller' => 'tags', 'action' => 'index', 3)); ?></li>
                    <li><?php echo $this->Html->link(__('S.A.L.E', true), array('admin' => false, 'controller' => 'tags', 'action' => 'index', 6)); ?></li>
                    <li><a href="http://www.ropandruppies.com" target="_blank"></a></li>
                </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content">

            <?php echo $this->Html->script('jquery/jquery-1.4.4.min'); ?>
            <?php echo $this->Html->script('jquery/jquery.tools.min'); ?>

            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>

            <?php echo $content_for_layout; ?>

        </div>
        <div id="footer">
			<div class="container">
				<div class="col-1">
					<p><?php echo $this->Html->link(__('Information', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index')); ?></p>
					<?php echo $this->Html->link(__('How To Shop', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 5)); ?><br/>
					<?php echo $this->Html->link(__('How To Pay', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 6)); ?><br/>
					<?php echo $this->Html->link(__('How To Claim', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 4)); ?><br/>
					<?php echo $this->Html->link(__('Terms & Conditions', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 8)); ?><br/>
				</div>
				<div class="col-2">
					<p><?php echo $this->Html->link(__('About Us', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 1)); ?></p>
                    <?php echo $this->Html->link(__('Stores Location', true), array('admin' => false, 'controller' => 'stores', 'action' => 'index')); ?><br/>
                    <?php echo $this->Html->link(__('Partnership', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 9)); ?><br/>
                    <?php echo $this->Html->link(__('Career With Us', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 7)); ?><br/>
                    <?php echo $this->Html->link(__('Contact Us', true), array('admin' => false, 'controller' => 'contacts', 'action' => 'index')); ?>
				</div>
				<div class="col-3">
                    <a class="twitter" href="http://twitter.com/geeeight/" target="_blank"><?php __('Follow Our Twiter'); ?></a><br/>
                    <a class="facebook" href="http://www.facebook.com/pages/Gee-Eight/47642781969" target="_blank"><?php __('Became Fan of Us'); ?></a><br/>
                    <a class="youtube" href="http://www.youtube.com/user/geeeightindonesia" target="_blank"><?php __('Our Videos on Youtube'); ?></a>
				</div>
                <div class="col-4">
                    <?php echo $this->Html->link(__('Buyer', true), array(
                        'admin' => false, 'controller' => 'pingbox', 'action' => 'index', 'buyer'
                    ), array(
                        'class' => 'buyer livechat'
                    )); ?><br/>
                    <?php echo $this->Html->link(__('Reseller', true), array(
                        'admin' => false, 'controller' => 'pingbox', 'action' => 'index', 'reseller'
                    ), array(
                        'class' => 'reseller livechat'
                    )); ?>
				</div>
                <div class="col-5">
                    <p>newsletter</p>
                    <?php echo $this->Form->create('Newsletter', array('class' => 'newsletter', 'controller' => 'newsletters', 'action' => 'index')); ?>
						<fieldset>
                            <?php echo $this->Form->input('email_address', array(
                                'label' => false,
                                'class' => 'newsletter-input tip',
                                'title' => __('your email address', true),
                            )); ?>
                            <input type="image" src="<?php echo $this->webroot; ?>images/button-newsletter.png" alt="newsletter"/>
						</fieldset>
					<?php echo $this->Form->end(); ?>                            
				</div>                          
                           
				<div class="copyright">
                    <hr/>
                    <br/>
					&copy; 2011 Gee*Eight All Right Reserved
				</div>
                <div class="clear"></div>
            </div>
        </div>
        </div>
        <?php echo $scripts_for_layout; ?>
        <?php echo $this->Html->script('jquery/jquery.dd'); ?>
        <?php echo $this->Html->script('jquery/jquery.labelify'); ?>
        <?php echo $this->Html->script('custom-form-elements'); ?>
        <?php echo $this->Html->script('prettyCheckboxes'); ?>
        <?php echo $this->Html->script('app/layout_default'); ?>
        <?php echo $this->Html->script('jquery/jquery.lightbox-0.5'); ?>
        <div id="fb-root"></div>
        <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({
                appId: '175329375833926',
                status: true,
                cookie: true,
                xfbml: true
            });
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
        </script>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4d39567e0a6b3f18"></script>
    </body>
</html>
