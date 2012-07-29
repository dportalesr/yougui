<?php
echo $this->element('top');
	
	if($items){
		foreach($items as $item){
			echo $html->div('faq'),
				$html->div('title title2',$item['Faq']['nombre'],array('class'=>'pregunta')),
				$html->div('respuesta tmce',$item['Faq']['descripcion'].''),
			'</div>';
		}
	} else 
		echo $html->para('noresults','No hay elementos que mostrar');
	?>
</div>
</div><!-- end of content -->