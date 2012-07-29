<?php
class Nodeimg extends AppModel {
	var $name = 'Nodeimg';
	var $actsAs = array('File'=>array('portada'=>'node_id'));
	var $belongsTo = array(
		'Node' => array(
			'className'=>'Node',
			'counterCache' => true
		)
	);
	
}
?>