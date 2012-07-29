<?php
class Poption extends AppModel {
	var $name = 'Poption';
	var $displayField = 'opcion';
	var $labels = array('opcion'=>'opción');
	var $belongsTo = array('Poll');
}
?>