<?php
class Magazineimg extends AppModel {
	var $name = 'Magazineimg';
	var $labels = array('src'=>'Archivo');
	var $actsAs = array('File' => array('portada'=>'magazine_id','fields'=>array('src'=>array('maxsize'=>512000))));
	var $belongsTo = array(
		'Magazine' => array(
			'className' => 'Magazine',
			'counterCache' => true
		)
	);
	var $validate = array(
		'src' => array(
			'rule' => array('between', 1,255),
			'allowEmpty' => false,
			'message' => 'Ingrese la imagen para mostrar'
		)
	);
}
?>