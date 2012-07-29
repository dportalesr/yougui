<?php
class Podcast extends AppModel {
	var $name = 'Podcast';
	var $actsAs = array('File' => array('fields'=>array('src'=>array('types'=>'mp3|wma','dir'=>'upload/audio'))));
	var $labels = array('comment_count'=>'Comentarios');
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('Comment.parent'=>'Podcast'),
			'dependent'=>true
		)
	);
	var $validate = array();
}
?>