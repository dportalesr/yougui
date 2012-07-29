<?php
class Video extends AppModel {
	var $name = 'Video';
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('Comment.parent'=>'Video'),
			'dependent'=>true
		)
	);
    var $validate = array();
}
?>