<?php fb($this->Form->validationErrors,'$this->Form->validationErrors');
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('inputs',array(
		'schema'=>array(
			'category'=>array('div'=>'col col50 category'),
			'currency_id'=>array('default'=>1,'div'=>'col col16'),
			'precio'=>array('div'=>'col col16'),
			'stock'=>array('div'=>'col col16 omega'),
			'Type'=>array(
				'elist',
				'fields'=>array(
					'id',
					'nombre'=>array('edit'=>1),
					'precio'=>array('edit'=>1,'optional'=>'Precio'),
					'stock'=>array('edit'=>1,'optional'=>'Stock'),
					'orden'
				),
				'opts'=>array('data'=>isset($this->data['Type']) && $this->data['Type'] ? $this->data['Type'] : $orderdata,'sort'=>1,'delete'=>1,'adder'=>'elistAdder'),
				'afterof'=>'tipo_etiqueta'
			)
		)
	)),
	$this->element('tinymce',array('advanced'=>1,'size'=>'m'));
?>