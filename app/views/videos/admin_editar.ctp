<?
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('inputs',array(
		'schema'=>array(
			'url'=>array(
				'label'=>'Dirección del Video:',
				'tip'=>array('Ej.: http://youtube.com/watch?v=XXXXXX','Inserte aquí la dirección del video en Youtube.')
			)
		)
	)),
	$this->element('tinymce',array('advanced'=>1));
?>