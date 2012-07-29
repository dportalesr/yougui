<?php
echo
	$this->element('top'),
	$html->div('clear'),
		$html->div('form'),
			$html->div('title title2','Ponte en Contacto'),
			$html->para('note',''),
	
			$form->create('Contact',array('id'=>'ContactForm','url'=>'/contacto/enviar')),
			$form->input('mail',array('div'=>'hide')),
			$html->div('subform'),
				$this->Captcha->input(),
				$form->input('nombre',array('label'=>'Nombre:')),
				$form->input('email',array('label'=>'E-mail:')),
				$form->input('mensaje',array('label'=>'Mensaje:','rows'=>9,'cols'=>35)),
				$form->submit('Enviar'),
			'</div>',
			$form->end(),
		'</div>',
		$html->div('info'),
			$html->div('title title3','Oficinas'),
			$html->para(null,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'),
			$html->para(null,'Sed diam nonummy nibh euismod tincidunt.'),
			$html->para(null,'laoreet dolore magna.'),
			/*
			$html->div('title title3','Cómo llegar'),
			$html->link($html->image('mapa.jpg'),'/img/mapa.jpg',array('class'=>'pulsembox mapa')),
			*/
		'</div>',
	'</div>',

	$moo->ajaxform('ContactForm');
?>
</div>
</div>