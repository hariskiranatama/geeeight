<?php
/**
 * Model template file.
 *
 * Used by bake to create new Model files.
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
 * @subpackage    cake.console.libs.templates.objects
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

echo "<?php\n"; ?>
class <?php echo $name ?> extends <?php echo $plugin; ?>AppModel {
    var $name = '<?php echo $name; ?>';
<?php if ($useDbConfig != 'default'): ?>
    var $useDbConfig = '<?php echo $useDbConfig; ?>';
<?php endif;?>
<?php if ($useTable && $useTable !== Inflector::tableize($name)):
    $table = "'$useTable'";
    echo "    var \$useTable = $table;\n";
endif;
if ($primaryKey !== 'id'): ?>
    var $primaryKey = '<?php echo $primaryKey; ?>';
<?php endif;
if ($displayField): ?>
    var $displayField = '<?php echo $displayField; ?>';
<?php endif;

if (!empty($validate)):
    echo "    var \$validate = array(\n";
    foreach ($validate as $field => $validations):
        echo "        '$field' => array(\n";
        foreach ($validations as $key => $validator):
            echo "            '$key' => array(\n";
            echo "                'rule' => array('$validator'),\n";
            echo "                //'message' => 'Your custom message here',\n";
            echo "                //'allowEmpty' => false,\n";
            echo "                //'required' => false,\n";
            echo "                //'last' => false, // Stop validation after this rule\n";
            echo "                //'on' => 'create', // Limit validation to 'create' or 'update' operations\n";
            echo "            ),\n";
        endforeach;
        echo "        ),\n";
    endforeach;
    echo "    );\n";
endif;

foreach ($associations as $assoc):
    if (!empty($assoc)):
?>

    //The Associations below have been created with all possible keys, those that are not needed can be removed
<?php
        break;
    endif;
endforeach;

foreach (array('hasOne', 'belongsTo') as $assocType):
    if (!empty($associations[$assocType])):
        $typeCount = count($associations[$assocType]);
        echo "\n    var \$$assocType = array(";
        foreach ($associations[$assocType] as $i => $relation):
            $out = "\n        '{$relation['alias']}' => array(\n";
            $out .= "            'className' => '{$relation['className']}',\n";
            $out .= "            'foreignKey' => '{$relation['foreignKey']}',\n";
            $out .= "            'conditions' => '',\n";
            $out .= "            'fields' => '',\n";
            $out .= "            'order' => ''\n";
            $out .= "        )";
            if ($i + 1 < $typeCount) {
                $out .= ",";
            }
            echo $out;
        endforeach;
        echo "\n    );\n";
    endif;
endforeach;

if (!empty($associations['hasMany'])):
    $belongsToCount = count($associations['hasMany']);
    echo "\n    var \$hasMany = array(";
    foreach ($associations['hasMany'] as $i => $relation):
        $out = "\n        '{$relation['alias']}' => array(\n";
        $out .= "            'className' => '{$relation['className']}',\n";
        $out .= "            'foreignKey' => '{$relation['foreignKey']}',\n";
        $out .= "            'dependent' => false,\n";
        $out .= "            'conditions' => '',\n";
        $out .= "            'fields' => '',\n";
        $out .= "            'order' => '',\n";
        $out .= "            'limit' => '',\n";
        $out .= "            'offset' => '',\n";
        $out .= "            'exclusive' => '',\n";
        $out .= "            'finderQuery' => '',\n";
        $out .= "            'counterQuery' => ''\n";
        $out .= "        )";
        if ($i + 1 < $belongsToCount) {
            $out .= ",";
        }
        echo $out;
    endforeach;
    echo "\n    );\n\n";
endif;

if (!empty($associations['hasAndBelongsToMany'])):
    $habtmCount = count($associations['hasAndBelongsToMany']);
    echo "\n    var \$hasAndBelongsToMany = array(";
    foreach ($associations['hasAndBelongsToMany'] as $i => $relation):
        $out = "\n        '{$relation['alias']}' => array(\n";
        $out .= "            'className' => '{$relation['className']}',\n";
        $out .= "            'joinTable' => '{$relation['joinTable']}',\n";
        $out .= "            'foreignKey' => '{$relation['foreignKey']}',\n";
        $out .= "            'associationForeignKey' => '{$relation['associationForeignKey']}',\n";
        $out .= "            'unique' => true,\n";
        $out .= "            'conditions' => '',\n";
        $out .= "            'fields' => '',\n";
        $out .= "            'order' => '',\n";
        $out .= "            'limit' => '',\n";
        $out .= "            'offset' => '',\n";
        $out .= "            'finderQuery' => '',\n";
        $out .= "            'deleteQuery' => '',\n";
        $out .= "            'insertQuery' => ''\n";
        $out .= "        )";
        if ($i + 1 < $habtmCount) {
            $out .= ",";
        }
        echo $out;
    endforeach;
    echo "\n    );\n\n";
endif;
?>
}
<?php echo ''; ?>