<?php
class ItemRecomend extends AppModel {
    var $name = 'ItemRecomend';
    //var $displayField = 'recomend_id';

    var $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Recomend' => array(
            'className' => 'Item',
            'foreignKey' => 'recomend_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    
/*    function afterSave(){
        $this->deleteAll(array(
                'ItemRecomend.recomend_id' => null,
            ));
    }*/
}
