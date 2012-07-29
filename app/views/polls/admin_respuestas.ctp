<?php
echo
	$this->element('adminhdr',array(
		'title'=>'Respuestas',
		'links'=>array(
			array('text'=>'Regresar','href'=>array('action'=>'editar',$pollid,'admin'=>true),'class'=>'back'),
			'adder'
		)
	)),
	$html->div('title title2 pollquestion',$pollquestion ? $pollquestion : ''),
	$html->div('OrderContainer'),
		$form->create('Answer',array('url'=>$this->here)),
		$html->tag('p',$form->submit('Guardar Cambios',array('div'=>false,'class'=>'submitRt')).$html->image('admin/handlerguide.gif').' Haga clic en estos botones y arrastre para reordenar la lista.',array('id'=>'elist_instructions')),
		$moo->elist('Answer',
			array(
				'id',
				'nombre'=>array('hide'=>0,'edit'=>1),
				'votos'=>array('edit'=>0,'hide'=>0,'label'=>'# Votos: ')
			),
			array('data'=>$orderdata,'sort'=>1,'min'=>0,'adder'=>'elist_adder','remover'=>1)
		,array('id'=>'Answer_elist')),
		$form->end(),
	'</div>';
?>
