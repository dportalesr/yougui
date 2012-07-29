<?php
class Serviceimg extends AppModel {
	var $name = 'Serviceimg';
	var $actsAs = array('File'=>array('portada'=>'service_id'));
	var $belongsTo = array(
		'Service' => array(
			'className'=>'Service',
			'counterCache' => true
		)
	);
	
}
?>