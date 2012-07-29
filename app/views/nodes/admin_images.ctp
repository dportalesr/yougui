<?php
echo
	$this->element('temp/admin_images',array(
		'links'=>array(
			'back'=>array(
				'text'=>'Regresar',
				'class'=>'back',
				'href'=>array('action'=>'index', isset($this->passedArgs[0]) ? $this->passedArgs[0] : null)
			)
		)
	)
);
?>