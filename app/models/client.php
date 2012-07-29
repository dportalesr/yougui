<?php
class Client extends AppModel {
	var $name = 'Client';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array();
	var $hasMany = array(
		'Order'=>array(
			'className'=>'Order',
			'dependent'=>true
		)
	);    
}
?>