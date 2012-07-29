<?php
echo
	$this->element('top',array('wide'=>1)),
	$html->div(null,null,array('id'=>'results')),
		$html->div('title title2','Elementos que tienen la etiqueta "'.$tag['Tag']['tag'].'"');

		foreach($items as $item)
			echo $this->element('th',array('item'=>$item,'model'=>'Post'));

	echo $this->element('pages',array('model'=>'Post'));
?>
	</div>
</div>
</div>