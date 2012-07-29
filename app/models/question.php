<?php
class Question extends AppModel {
	var $name = 'Question';
	var $labels = array('nombre'=>'Pregunta');
	var $belongsTo = array(
		'Poll' => array(
			'className' => 'Poll',
			'counterCache' => true
		)
	);
	
	var $hasMany = array(
		'Answer',
		'Visitor' => array(
			'className' => 'Visitor',
			'foreignKey'=>'item_id',
			'conditions'=>array('Visitor.item'=>'Question')
		)
	);
}
?>