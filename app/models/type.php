<?php
class Type extends AppModel {
	var $name = 'Type';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array(
		//'stock'=>array('rule'=>array('between', 1,255), 'allowEmpty'=>false,'required'=>true, 'message'=>'WUT Ingrese un valor entre 1 y 255 caracteres de longitud.')
	);
	var $belongsTo = array(
	    	'Product'=>array(
	    		'className'=>'Product',
	    		'counterCache'=>true
	    	)
	    );    
}
?>