<?php
App::import('Model',$_m[0]);
$m = new $_m[0]();
$parent = isset($parent) ? $parent : false;

////

echo $this->element('adminhdr',array('links'=>array('adder')));

if($m->asTree) {
	echo 
	$html->div(null,null,array('id'=>'crumbs')),
		$html->link('Principales',array('action'=>'index'),array('class'=>'ib')),
		$html->tag('span','',array('class'=>'ib point'));
		
		foreach($path as $link)
			echo
				$html->tag('span','',array('class'=>'ib tail')),
				$html->link($link[$_m[0]]['nombre'],array($link[$_m[0]]['id']),array('class'=>'ib')),
				$html->tag('span','',array('class'=>'ib point'));

	echo '</div>';
}

echo
	$html->div('OrderContainer'),
		$form->create($_m[0],array('url'=>$this->here)),
		$html->tag('p',null,array('id'=>'elist_instructions')),
			$form->submit('Guardar Cambios',array('div'=>false,'class'=>'submitRt')),
			$html->tag('span',' Haga clic en estos botones y arrastre para reordenar la lista.'),
		'</p>',
		$moo->elist($_m[0],
			array('id','nombre'=>array('hide'=>0,'edit'=>1)),
			array(
				'zoom'=>$m->asTree,
				'data'=>$orderdata,
				'sort'=>1,
				'adder'=>'elistAdder',
				'remover'=>1,
				'min'=>0,
				'confirmdelete'=>1
				),
			array('id'=>$_m[0].'_elist')
		),
		isset($parent) && $parent ? $form->input('parent_id',array('value'=>$parent,'type'=>'hidden')):'',
		$form->end(),
	'</div>';
?>