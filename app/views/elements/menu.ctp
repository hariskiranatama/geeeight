<div class="menu">
    <img class="logo2" src="<?php echo $this->webroot; ?>images/logo2.png" alt="logo2"/>
    <ul>
        <li><?php echo $this->Html->link(__('Gallery', true),
                                         array('admin' => false, 'controller' => 'galleries', 'action' => 'index'),
                                         array('class' => $this->params['controller'] == 'galleries' ? 'selected' : null)); ?>
        </li>
        <li><?php echo $this->Html->link(__('News & Events', true),
                                         array('admin' => false, 'controller' => 'events', 'action' => 'index'),
                                         array('class' => $this->params['controller'] == 'events' ? 'selected' : null)); ?>
        </li>
        <li><?php echo $this->Html->link(__('Information', true),
                                         array('admin' => false, 'controller' => 'info_pages', 'action' => 'index'),
                                         array('class' => ($this->params['controller'] == 'info_pages' AND count($this->params['pass']) > 0 AND $this->params['pass'][0] == 1) ? 'selected' : null)); ?>
        </li>
        <li><?php echo $this->Html->link(__('About Us', true),
                                         array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 1),
                                         array('class' => ($this->params['controller'] == 'info_pages' AND count($this->params['pass']) > 0 AND $this->params['pass'][0] == 1) ? 'selected' : null)); ?>
        </li>
        <li><?php echo $this->Html->link(__('Site Map', true),
                                         array('admin' => false, 'controller' => 'sitemaps', 'action' => 'index'),
                                         array('class' => ($this->params['controller'] == 'sitemaps' AND count($this->params['pass']) > 0 AND $this->params['pass'][0] == 1) ? 'selected' : null)); ?>
        </li>
    </ul>
</div>