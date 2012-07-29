<?php
class Doccategory extends AppModel {
	var $name = 'Doccategory';
	var $actsAs = array('Tree');
	var $asTree = false;
	var $validate = array(
		'nombre' => array(
			'longitud'=>array(
				'rule' => array('between',1,255),
				'required'=>true,
				'allowEmpty'=>false,
				'message' => 'Ingrese un nombre entre 1 y 255 caracteres.'
			),
			'vacio'=>array(
				'rule' => 'notEmpty',
				'required'=>true,
				'allowEmpty'=>false,
				'message' => 'Ingrese un nombre entre 1 y 255 caracteres.'
			)
		)
	);
}
?>