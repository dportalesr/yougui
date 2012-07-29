<?php
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('inputs',array(
		'before'=>$podcast ? $html->div(null,'',array('id'=>'pPlayer')).$moo->player(false,$podcast,array('id'=>'pPlayer')):'',
	)),
	$this->element('tinymce');
?>