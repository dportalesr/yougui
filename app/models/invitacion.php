<?php
class Invitacion extends AppModel {
	var $name = 'Invitacion';
	var $_schema = array(
		'nombre_de' =>array('type'=>'string', 'length'=>100,'label'=>'Tu nombre'),
		'email_de' =>array('type'=>'string', 'length'=>255,'label'=>'Tu E-mail'),
		'nombre_para' =>array('type'=>'string', 'length'=>100,'label'=>'Para'),
		'email_para' =>array('type'=>'string', 'length'=>255,'label'=>'E-mail'),
		'mensaje' =>array('type'=>'text','label'=>'Mensaje')
	);
	
	var $useTable = false;
	var $validate = array(
		'nombre_de' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Este campo es obligatorio.'
		),
		'email_de' => array(
			'format'=>array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La dirección de correo no es válida.'
			),
			'vacio' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Este campo es obligatorio.'
			)		
		),
		'nombre_para' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Este campo es obligatorio.'
		),
		'email_para' => array(
			'format'=>array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La dirección de correo no es válida.'
			),
			'vacio' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Este campo es obligatorio.'
			)		
		)
	);
}
?>