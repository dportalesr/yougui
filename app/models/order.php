<?php
class Order extends AppModel {
	var $name = 'Order';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array();
	var $belongsTo = array(
		'Client'=>array(
			'className'=>'Client',
			'counterCache'=>true
		)
	);
	var $hasMany = array(
		'OrderDetail'=>array(
			'className'=>'OrderDetail',
			'dependent'=>true
		)
	);    
}
?>