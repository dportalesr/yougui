<?php
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('inputs',array(
		'after'=>	$html->link('Agregar Pregunta','javascript:;',array('id'=>'elistAdder','class'=>'adminButton add')).
			$util->tip(array('En la siguiente lista podrá agregar, editar, eliminar y ordenar las <b>preguntas</b> de la encuesta. Para ordenar arrastre desde el área punteada.','Preguntas de Encuesta')).
			$moo->elist('Question',
				array('id','nombre'=>array('edit'=>1,'hide'=>0)),
				array(
					'min'=>1,
					'sort'=>1,
					'adder'=>'elistAdder',
					'remover'=>1,
					'custom'=>array(array('text'=>'Respuestas','action'=>'admin_respuestas'))
				),
				array('id'=>'Poption_elist')
			)
	)),
	$this->element('tinymce');
?>