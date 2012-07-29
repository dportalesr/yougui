<?php
echo
	$this->element('top'),
	$this->element('crumbs'),
	$html->div('detail'),
		$html->tag('h1',$item[$_m[0]]['nombre'],array('class'=>'title')),
		$html->para('date',$util->fdate('s',$item[$_m[0]]['created'])),
		
		$this->element('inlinegallery',array('data'=>$item[$_m[0].'img'],'model'=>$_m[0].'img')),
	
		$html->div('desc tmce',''.$item[$_m[0]]['descripcion']),		
		///////
	
		$this->element('share'),
		$this->element('comments'),
	'</div>';
?>
</div>
</div><!-- content -->