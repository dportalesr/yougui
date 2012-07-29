<?php
echo
	$this->element('adminhdr'),
	$html->div('OrderContainer'),
		$form->create($_m[0],array('url'=>$this->here)),
		$html->tag('p',$form->submit('Guardar Cambios',array('div'=>false,'class'=>'submitRt')).$html->image('admin/handlerguide.gif').' Haga clic en estos botones y arrastre para reordenar la lista.',array('id'=>'elist_instructions')),
		$moo->elist($_m[0],
			array('id','tag'=>array('hide'=>0,'edit'=>1)),
			array(
				'data'=>$orderdata,
				'sort'=>0,
				//'adder'=>'elistAdder',
				'remover'=>1,
				'zoom'=>0,
				'min'=>0,
				'confirmdelete'=>1
			),
			array('id'=>$_m[0].'_elist')
		),
		isset($parent) && $parent ? $form->input('parent_id',array('value'=>$parent,'type'=>'hidden')):'',
		$form->end(),
	'</div>';
?>
