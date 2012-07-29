<?php
class Eventimg extends AppModel {
	var $name = 'Eventimg';
	var $actsAs = array('File'=>array('portada'=>'event_id'));
	var $belongsTo = array(
		'Event' => array(
			'className'=>'Event',
			'counterCache' => true
		)
	);
}
?>