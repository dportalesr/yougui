<?php
class Service extends AppModel {
	var $name = 'Service';
	var $labels = array('serviceimg_count'=>'Imágenes');
	var $hasMany = array(
		'Serviceimg'=>array(
			'className'=>'Serviceimg',
			'dependent' => true
		)
	);
	var $hasOne = array(
		'Serviceportada'=>array(
			'className'=>'Serviceimg',
			'foreignKey'=>'service_id',
			'conditions'=>'Serviceportada.portada = 1'
		)
	);
	var $validate = array();
}
?>