<?php
$header = isset($header) ? $header : false;
$filter = isset($filter) ? $filter : false;
$model = ucfirst(isset($model) ? $model : $_m[0]);
$belongs = ucfirst(isset($belongs) ? $belongs : $model);
$addclass = isset($addclass) && $addclass ? $addclass : '';
$current = isset($current) && $current ? $current : false;

if($model && $items = Cache::read(strtolower($model).'_recursive')){
	echo $html->div('recent');
		if($header)
			echo $html->div('title title2',$header);
			
		echo $util->recursivelist(
			$items,
			array(
				'current'=>$current,
				'model'=>$model,
				'belongs'=>$belongs,
				'listClass'=>'recent'
			),
			$filter
		);

	echo '</div>';
}
?>