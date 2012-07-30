<?php
echo
	$html->div('footer'),
		$html->div('top'),
			$html->div('center'),
				$html->image('gecko.png',array('alt'=>'gecko.png','class'=>'gecko')),
				$html->div('clear'),
					$html->para('column quote',$html->tag('span','“').'Cambiando nuestra forma de pensar'.$html->tag('span','”')),

					$html->div('column enlaces'),
						$html->div('title title4','Enlaces'),
						$html->tag('ul'),
							$html->tag('li',$html->link('Conceptos básicos de lógica','#')),
							$html->tag('li',$html->link('Lenguajes de programación','#')),
						'</ul>',
					'</div>',

					$html->div('column redes'),
						$html->div('title title4','Redes'),
						$html->tag('ul'),
							$html->tag('li',$html->link('facebook','#',array('class'=>'facebook'))),
							$html->tag('li',$html->link('Twitter','#',array('class'=>'twitter'))),
						'</ul>',
					'</div>',
				'</div>',
			'</div>',
		'</div>',
		$html->div('bottom'),
			$html->div('center'),
				$html->link('PULSEM : Web + Identidad + Consultoría','http://pulsem.mx',array('id'=>'pulsem')),
				$html->para(null,'Política de privacidad. Avisos legales. Informar violación de la marca registrada.'),
				$html->para(null,'&copy; '.date('Y').' por colaboradores de Yougui. El contenido está disponible bajo una licencia de Creative Commons.'),
			'</div>',
		'</div>';
?>
</div><!-- .footer -->