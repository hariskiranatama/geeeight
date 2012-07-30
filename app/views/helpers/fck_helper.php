<?php 
class FckHelper extends Helper {

    var $helpers = Array('Html', 'Javascript');

    function load($id,$options_=array()) {
        $options = array(
                    'language'=>'it',
                    'uiColor'=>'#7E9DCC',
                    'toolbar'=>'Full',
                    );
        if(!empty($options_)) array_merge($options,$options_);
        $did = '';
        foreach (explode('.', $id) as $v) {
            $did .= Inflector::camelize($v);
        }
        $did = Inflector::humanize($did);
        
        $code = " if (CKEDITOR.instances['".$did."']) {
                    CKEDITOR.remove(CKEDITOR.instances['".$did."']);
                    cckeditor".$did.".destroy();
                    cckeditor".$did." = null;
                 }\n";
        $code .= " cckeditor".$did." = CKEDITOR.replace( '".$did."',".$this->Javascript->object($options).");\n";
        return $this->Javascript->codeBlock($code); 
    }
}
?>