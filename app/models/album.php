<?php
class Album extends AppModel {
	var $name = 'Album';
	var $labels = array(
		'comment_count'=>'Comentarios',
		'albumimg_count'=>'Imágenes'
	);
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('Comment.parent'=>'Album'),
			'dependent'=>true
		),
		'Albumimg'=>array(
			'className'=>'Albumimg',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'Albumportada'=>array(
			'className'=>'Albumimg',
			'foreignKey'=>'album_id',
			'conditions'=>'Albumportada.portada = 1'
		)
	);
	var $validate = array();
}
?>