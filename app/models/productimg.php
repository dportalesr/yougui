<?php
class Productimg extends AppModel {
	var $name = 'Productimg';
	var $actsAs = array('File'=>array('portada'=>'product_id'));
	var $belongsTo = array(
		'Product' => array(
			'className'=>'Product',
			'counterCache' => true
		)
	);
}
?>