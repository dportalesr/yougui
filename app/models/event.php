<?php
class Event extends AppModel {
	var $name = 'Event';
	var $labels = array(
		'comment_count'=>'comentarios',
		'eventimg_count'=>'Imágenes'
	);
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('parent'=>'Event'),
			'dependent'=>true
		),
		'Eventimg'=>array(
			'className'=>'Eventimg',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'Eventportada'=>array(
			'className'=>'Eventimg',
			'foreignKey'=>'event_id',
			'conditions'=>'Eventportada.portada = 1'
		)
	);
}
?>