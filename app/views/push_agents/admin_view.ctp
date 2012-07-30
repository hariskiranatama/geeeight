<div class="pushAgents view">
<h2><?php  __d("admin", 'Push Agent'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $pushAgent['PushAgent']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Auth Key'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $pushAgent['PushAgent']['auth_key']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $pushAgent['PushAgent']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $pushAgent['PushAgent']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Push Agent', true), array('action' => 'edit', $pushAgent['PushAgent']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Push Agent', true), array('action' => 'delete', $pushAgent['PushAgent']['id']), null, sprintf(__('Are you sure you want to delete this push agent?', true), $pushAgent['PushAgent']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Push Agents', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Push Agent', true), array('action' => 'add')); ?> </li>
    </ul>
</div>
