<?php
$id = isset($id) && $id ? $id : 'carousel';
$model = isset($model) && $model ? $model : 'Carousel';
$size = isset($size) && $size ? explode('x',$size) : false;
$url = isset($url) && $url ? $url : false;
$conditions = isset($conditions) && $conditions ? $conditions : array();
$defaults = array('nav'=>'out');
$opts = isset($opts) && $opts ? am($defaults,$opts) : $defaults;

if($data = isset($data) && $data ? $data : Cache::read(strtolower($model).'_showcase')){

	echo $html->div('showcase',null,array('id'=>$id));
	
	foreach($data as $snap){
		$it = $model && isset($snap[$model]) ? $snap[$model] : $snap;
		
		if(isset($it['enlace']) && $it['enlace'])
			echo $html->link(
				$size ? $resize->resize($it['src'],array('w'=>$size[0],'h'=>$size[1])) : $html->image('/'.$it['src']),
				$url ? $url : $it['enlace'],
				array('target'=>'_blank','rel'=>'nofollow','class'=>'item')
			);
		else
			echo $size ? $resize->resize($it['src'],array('w'=>$size[0],'h'=>$size[1],'atts'=>array('class'=>'item'))) : $html->image('/'.$it['src'],array('class'=>'item'));
		
		echo $html->div('caption',''.isset($it['descripcion']) ? $it['descripcion'] : '');
	}
	echo '</div>';
	
	$moo->showcase($id,$opts);
}
?>