<?php
class Currency extends AppModel {
	var $name = 'Currency';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array();
	var $hasMany = array(
		'Product'=>array(
			'className'=>'Product',
			'dependent'=>true
		)
	);    
}
?>