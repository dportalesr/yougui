<?php
class OrderDetail extends AppModel {
	var $name = 'OrderDetail';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array();
	var $belongsTo = array(
		'Order'=>array(
			'className'=>'Order',
			'counterCache'=>true
		),
		'Product'=>array(
			'className'=>'Product',
			'counterCache'=>true
		)
	);
}
?>