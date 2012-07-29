<?php
if($item){
	$v = isset($v) && $v ? 'v' : '';
	$model = isset($model) ? $model : $_m[0];
	$comments = isset($comments) ? $comments : false;
	$mini = isset($mini) ? $mini : false;
	$layout = isset($layout) ? $layout : array();
	$class = isset($class) && $class ? $class : '';
	$thopts = isset($thopts) && $thopts ? $thopts : array('w'=>164,'h'=>128,'fill'=>true);
	
	$th = array(
		'img'=>false,
		'nombre'=>false,
		'fecha'=>false,
		'desc'=>false,
		'comments'=>false,
		'mas'=>false
	);
	
	if($layout){
		$fill = array_fill(0,sizeof($layout),false);
		$th = array_combine($layout,$fill);
	}
	
	$url = array(
		'controller'=>Inflector::tableize($model),
		'action'=>'ver',
		'id'=>isset($item[$model]['slug']) && $item[$model]['slug'] ? $item[$model]['slug'] : $item[$model]['id']
	);

	switch($model){
		case 'Podcast':
			$th['img'] = $html->div('thPlayer',$html->para(null,'Cargando...',array('id'=>'podPlayer_'.$item[$model]['id']))).
					$moo->player(false,$item[$model]['src'],array('id'=>'podPlayer_'.$item['Podcast']['id']));
		break;
		//////////
		case 'Video':
			$th['mas'] = 'Ver video';
		break;
		//////////
		case 'Magazine':
			$thopts =  array('w'=>128,'h'=>168);
		break;
		//////////
		case 'Event':
			$th['fecha'] = $html->para('date',$util->fdate('s',$item[$model]['fecha']));
			
			if($item[$model]['descripcion'])
				$th['mas'] = 'Leer más';
		break;
		//////////
		case 'Album':
			$th['mas'] = 'Ver Fotos';
		break;
		//////////
		case 'Post':
		default:
		break;
	}

	if($mini) $th = array('nombre'=>$th['nombre']);
	
	foreach($th as $key => $value){
		if($value === false){
			switch($key){
				case 'img':
					if(!isset($thopts['url'])) $thopts['url'] = $url;
					$th[$key] = $util->th($item,$model,$thopts);
				break;

				case 'nombre':
					$th[$key] = $html->tag('h2',$html->link($item[$model]['nombre'],$url),'title');
				break;
				
				case 'fecha':
					$th[$key] = $html->para('date',$util->fdate('s',$item[$model]['created']));
				break;
				
				case 'desc':
					$th[$key] = $html->div('desc tmce',''.strip_tags($util->trim($item[$model]['descripcion']),'<b><i><strong><em>'));
				break;
				
				case 'comments':
					if($comments && isset($item[$model]['comment_count']))
						$th[$key] = $html->link($item[$model]['comment_count'],$url,array('class'=>'comments'));
				break;
			}
		} elseif($value && $key === 'mas')
			$th['mas'] = $html->div('more',$html->link($th['mas'],$url));
	}
	
	echo $html->div('thumb '.$class.' '.$v.' '.low($model), implode('',$th));

} else
	echo $html->para('noresults','No hay elemento para mostrar');
?>