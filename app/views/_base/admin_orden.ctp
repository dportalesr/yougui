<?php
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$html->div('OrderContainer'),
		$this->element('pages'),
		$form->create($_m[0],array('url'=>$this->here)),
		$html->tag('p',null,array('id'=>'elist_instructions')),
			$form->submit('Guardar Cambios',array('div'=>false,'class'=>'submitRt')),
			$html->tag('span',null,'limit_select'),
				$form->submit('Mostrar',array('name'=>'data[limit_change]','div'=>false)),
				$form->input('.limit',array('options'=>array(30=>30,50=>50),'div'=>false,'label'=>false)),
			'</span>',
			$html->tag('span',' Haga clic en estos botones y arrastre para reordenar la lista.'),
		'</p>',
		$moo->elist($_m[0],
			array('id','nombre'=>array('hide'=>0,'edit'=>0)),
			array('data'=>$orderdata,'sort'=>1,'offset'=>$offset)
		,array('id'=>$_m[0].'_elist')),
		$form->end(),
		$this->element('pages'),
	'</div>';
?>
