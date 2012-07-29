<?php
echo
	$this->element('top'),
	$this->element('crumbs'),
	
	$html->link('','',array('name'=>'top')),
	$html->tag('h1',$item[$_m[0]]['nombre'],array('class'=>'title')),
	$html->para('date',$util->fdate('s',$item[$_m[0]]['created'])),
	
	///
	
	$html->tag('p','',array('id'=>'pPlayer','class'=>'player')),
	$moo->player(false,$item['Podcast']['src'],array('id'=>'pPlayer')),
	$html->div('desc tmce',$item[$_m[0]]['descripcion']),
	
	///
	
	$this->element('share'),
	$this->element('commentbox');
?>
</div>
</div><!-- content -->