<?php
class Node extends AppModel {
	var $name = 'Node';
	var $actsAs = array('Tree');
	var $belongsTo = array(
		'Nodeparent'=>array(
			'className'=>'Node',
			'foreignKey'=>'parent_id'
		)
	);

	var $hasMany = array(
		'Nodeimg'=>array(
			'className'=>'Nodeimg',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'Nodeportada'=>array(
			'className'=>'Nodeimg',
			'foreignKey'=>'node_id',
			'conditions'=>'Nodeportada.portada = 1'
		)
	);
	var $validate = array();
}
?>