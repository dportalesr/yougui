<?php
$radioOpts = array(
	'Izquierda'=>$html->image('admin/postLayoutLeft.gif'),
	'Derecha'=>$html->image('admin/postLayoutRight.gif'),
	'Centro'=>$html->image('admin/postLayoutFull.gif')
);

echo
	$this->element('adminhdr',array('title'=>$_ts.' - '.$this->data[$_m[0]]['nombre'])),
	$html->div(null,null,array('id'=>'crumbs')),
		$html->link('#',array('action'=>'index'),array('class'=>'ib')),
		$html->tag('span','',array('class'=>'ib point'));
		
		foreach($path as $link)
			echo
				$html->tag('span','',array('class'=>'ib tail')),
				$html->link($link[$_m[0]]['nombre'],array($link[$_m[0]]['id']),array('class'=>'ib')),
				$html->tag('span','',array('class'=>'ib point'));
	
	echo '</div>',

	$form->create($_m[0], array('url'=>$this->here,'class'=>'catalog','type'=>'file'));
		
		//// Contenido del Nodo	
		
		if($parent){
			echo
				$html->link('Ver Fotos',array('action'=>'images',$this->passedArgs[0]),array('class'=>'adminButton photos')),
				$moo->moopload($_m[0].'img',10),
				$form->input('id',array('value'=>$this->data[$_m[0]]['id'],'type'=>'hidden')),
				$form->input('externo',array('value'=>$this->data[$_m[0]]['externo'],'label'=>'¿Es enlace externo?:')),
				$form->input('enlace',array('value'=>$this->data[$_m[0]]['enlace'],'label'=>'Enlace:','div'=>array('id'=>$_m[0].'EnlaceDiv'))),
				$form->input('descripcion',array('value'=>$this->data[$_m[0]]['descripcion'],'label'=>'Texto de '.$this->data[$_m[0]]['nombre'],'div'=>array('class'=>'input textarea ordercontenttext'))),
				$form->input('layout',array(
					'before'=>$html->div('label','Disposición de portada'.$util->tip('Indica la posición de la imagen principal (portada) dentro del texto del Artículo.')),
					'value'=>$this->data[$_m[0]]['layout'],
					'type'=>'radio',
					'legend'=>false,
					'options'=>$radioOpts
				)),
				$form->input($_m[0].'img.{n}.src',array(
					'type'=>'file',
					'label'=>'Imágenes:'.$util->tip(array('Peso máximo recomendado p/foto: 200 kB<br/>Tipos permitidos: JPG, JPEG, GIF, PNG<br/>La primera imagen se convertirá en la Portada','Especificaciones de Archivo'))
				)),
				$form->input('parent_id',array('value'=>$parent,'type'=>'hidden')),
				$this->element('tinymce',array('size'=>'l','advanced'=>1));
				$moo->addEvent($_m[0].'Externo','click','$("'.$_m[0].'EnlaceDiv").slide(this.get("checked") ? "in":"out");');
				$moo->buffer('$("'.$_m[0].'EnlaceDiv").slide($("'.$_m[0].'Externo").get("checked") ? "show":"hide");');
		}
	
		//// Nodos hijos
	echo
		$parent ? $html->tag('h2','Subsecciones',array('class'=>'sectionContentForm')):'',
		$html->link('Agregar Subsección','javascript:;',array('id'=>'elistAdder','class'=>'adminButton add')),
		$html->div('OrderContainer'),
			$html->tag('p','Haga clic en estos botones y arrastre para reordenar la lista.',array('id'=>'elist_instructions')),
			$moo->elist($_m[0],
				array('id','nombre'=>array('hide'=>0,'edit'=>1)),
				array(
					'data'=>$orderdata,
					'sort'=>1,
					'adder'=>'elistAdder',
					'remover'=>1,
					'zoom'=>1,
					'min'=>0,
					'confirmdelete'=>1
				),
				array('id'=>$_m[0].'_elist')
			),
		'</div>',
	$form->end('Guardar Cambios');
?>
