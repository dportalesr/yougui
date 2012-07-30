<?php
echo
	$html->div('contentwide'),
	$html->div('pad'),
		$html->tag('h2','YouGui es un sistema educativo diseñado para que niños, jóvenes y adultos aprendan lenguajes de programación.','title'),
		$html->div('desc intro'),
			$html->tag('h3','YouGui: You Are The Graphical User Interface','title'),
			$html->para(null,'YouGui es un sistema educativo diseñado para que niños, jóvenes y adultos aprendan lenguajes de programación aunados con conceptos de lógica, matemáticas, robótica, electrónica, computación, animación, videojuegos, etc., de una forma sencilla de entender y de una forma divertida.'),
			$html->para(null,'Nuestro objetivo es ayudar a los estudiantes a aprender a diseñar, crear e inventar cosas. No es sólo el aprendizaje mediante la práctica, es el aprendizaje por el diseño.'),
		'</div>',
		$html->div('logos_areas'),
			$html->para('ingles',$html->tag('span','Inglés')),
			$html->para('matematicas',$html->tag('span','Matemáticas')),
			$html->para('programacion',$html->tag('span','Programación')),
			$html->para('robotica',$html->tag('span','Robótica')),
			$html->para('videojuegos',$html->tag('span','Videojuegos')),
		'</div>';
?>
</div>
</div>