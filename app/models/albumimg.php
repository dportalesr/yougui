<?php
class Albumimg extends AppModel {
	var $name = 'Albumimg';
	var $actsAs = array('File'=>array('portada'=>'album_id'));
	var $belongsTo = array(
		'Album' => array(
			'className'=>'Album',
			'counterCache' => true
		)
	);
}
?>