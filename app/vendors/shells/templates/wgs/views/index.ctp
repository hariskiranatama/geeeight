<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="<?php echo $pluralVar; ?> index">
    <h2><?php echo "<?php __('{$pluralHumanName}'); ?>";?></h2>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                <th>#</th>
        <?php  foreach ($fields as $field):?>
            <th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>";?></th>
        <?php endforeach;?>
            <th class="actions"><?php echo "<?php __('Actions'); ?>";?></th>
        </tr>
    </thead>
    <tbody>
    <?php
    echo "<?php \$i = \$this->Paginator->counter(array('format' => '%start%')); ?>\n";
    echo "    <?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
    echo "    <tr>\n";
    echo "        <td><?php echo (\$i++); ?></td>\n";
    foreach ($fields as $field) {
        $isKey = false;
        if (!empty($associations['belongsTo'])) {
            foreach ($associations['belongsTo'] as $alias => $details) {
                if ($field === $details['foreignKey']) {
                    $isKey = true;
                    echo "        <td>\n            <?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n        </td>\n";
                    break;
                }
            }
        }
        if ($isKey !== true) {
            echo "        <td><?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>&nbsp;</td>\n";
        }
    }
    echo "        <td class=\"actions\">\n";
    echo "            <?php echo \$this->Html->link(__('View', true), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
    echo "            <?php echo \$this->Html->link(__('Edit', true), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
    echo "            <?php echo \$this->Html->link(__('Delete', true), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
    echo "        </td>\n";
    echo "    </tr>\n";
    echo "    <?php endforeach; ?>\n";
    ?>
    </tbody>
    </table>
    <p>
    <?php echo "<?php
    echo \$this->Paginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>";?>
    </p>

    <div class="paging">
    <?php echo "    <?php echo \$this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled')); ?>\n";?>
    | <?php echo "    <?php echo \$this->Paginator->numbers(); ?>\n"?>    |
    <?php echo "    <?php echo \$this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>\n";?>
    </div>
</div>
<div class="actions">
    <h3><?php echo "<?php __('Actions'); ?>"; ?></h3>
    <ul>
        <li><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "', true), array('action' => 'add')); ?>";?></li>
<?php
    $done = array();
    foreach ($associations as $type => $data) {
        foreach ($data as $alias => $details) {
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                echo "        <li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "', true), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
                echo "        <li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "', true), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
                $done[] = $details['controller'];
            }
        }
    }
?>
    </ul>
</div>