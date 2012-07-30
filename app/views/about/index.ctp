<?php
echo
	$this->element('top',array('wide'=>true)),
	$html->div('desc'),
		$html->tag('h3','El Sistema YouGui se basa en el Aprendizaje por Diseño','title'),
		$html->para(null,'Los alumnos trabajan en proyectos de diseño como participantes activos, dándoles un mayor sentido de control y la responsabilidad para el proceso de aprendizaje. Los proyectos de diseño:'),
		$html->tag('ul'),
			$html->tag('li','Alientan a los alumnos a buscar soluciones creativas a los problemas.','bullet_blue'),
			$html->tag('li','Suelen ser interdisciplinarios, reuniendo  ideas de arte, tecnología, matemáticas y ciencias.','bullet_green'),
			$html->tag('li','Ayudan a los alumnos a aprender a ponerse en la mente de otros, y a tener en cuenta cómo otros disfrutan de las cosas que ellos crean.','bullet_red'),
			$html->tag('li','Ofrecen oportunidades para la reflexión y la colaboración. Crean un ciclo positivo de retroalimentación del aprendizaje: Cuando los alumnos diseñan cosas, ellos obtienen nuevas ideas, lo que los lleva a diseñar nuevas cosas, de las cuales obtienen nuevas ideas, lo que los lleva a diseñar aun más cosas, y así sucesivamente.','bullet_orange'),
		'</ul>',
		$html->para(null,'El enfoque de aprendizaje por diseño YouGui está inspirado en dos importantes teorías del aprendizaje y la educación: el constructivismo y el construccionismo.'),
	'</div>';

//if($item) echo $html->div(null,$item[$_m[0]]['descripcion'],array('id'=>'aboutText'));
?>
</div>
</div>