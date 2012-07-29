<?php
class Document extends AppModel {
	var $name = 'Document';
	var $labels = array('src'=>'Archivo');
	var $actsAs = array(
		'File' => array(
			'portada'=>false,
			'fields'=>array(
				'src'=>array(
					'types'=>'docx|xlsx|ppt|pps|ppsx|pptx|doc|xls|pdf|jpg|gif|jpeg|png|zip|rar',
					'dir'=>'docs'
				)
			)
		)
	);
	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'counterCache' => true
		)
	);
	var $validate = array();
}
?>