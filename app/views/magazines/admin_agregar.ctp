<?php
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('inputs',array('schema'=>array('src'=>array('strict'=>'128 x 164')))),
	$this->element('tinymce',array('advanced'=>1,'size'=>'m'));
?>