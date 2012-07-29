<?php
class Faq extends AppModel{
	var $name = 'Faq';
	var $labels = array(
		'nombre'=>'pregunta',
		'descripcion'=>'respuesta'
	);
	var $validate = array();
}
?>