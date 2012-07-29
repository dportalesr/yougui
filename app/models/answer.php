<?php
class Answer extends AppModel {
	var $name = 'Answer';
	var $labels = array('nombre'=>'Respuesta');
	var $belongsTo = array('Question');
}
?>