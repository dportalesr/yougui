<?php
$title = isset($title) ? (is_string($title) ? $title : $_ts) : false;
$data = isset($data) && $data ? $data : false;
$model = isset($model) && $model ? $model : (isset($_m[0]) && $_m[0] ? $_m[0] : false);
$params = isset($params) ? $util->named($params) : '';
$class = isset($class) && $class ? $class : '';
$current = false;

if(isset($item) && $item){
	$current = reset($item);
	$current = $current['id'];
}

if($model && ($data || $items = Cache::read(strtolower($model).'_recent'))){
	echo $html->div('bulleted '.$class.' '.$this->params['controller']);
	
	if($title) echo $html->div('title title2',$title);

	echo $html->tag('ul');
	
	foreach($items as $it){
		$url = array('controller'=>Inflector::tableize($model),'action'=>'ver','id'=> isset($it[$model]['slug']) ? $it[$model]['slug']:$it[$model]['id']);
		echo $html->tag('li',$html->link($it[$model]['nombre'],$url),array('class'=>($it[$model]['id']==$current ? 'selected':'')));
	}
		
	echo '</ul></div>';
}
?>