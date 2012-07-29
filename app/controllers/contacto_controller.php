<?php
App::import('Controller','_base/Empty');
class ContactoController extends EmptyController {
	var $name = 'Contacto';
	var $components = array('Email');
	var $uses = array('Contact');
	var $helpers = array('Captcha');

	function enviar(){
		$this->Contact->set($this->data);
		if($this->Contact->validates()){
			$site = Configure::read('Site');
			$data = array(
				'nombre'=>$this->data['Contact']['nombre'],
				'email'=>$this->data['Contact']['email'],
				'empresa'=>$this->data['Contact']['empresa'],
				'mensaje'=>$this->data['Contact']['mensaje']
			);

			/*
			$this->Email->delivery = 'smtp';
			$this->Email->smtpOptions = array(
				'port'=>465,
				'timeout'=>30,
				'host' => 'ssl://smtp.gmail.com',
				'username'=>'webmaster@'.$this->domain,
				'password'=>'com97200'
			);
			*/
			$this->Contact->clean($data,false,false);
			$this->set($data);
			
			$this->Email->to = $site['email'];
			$this->Email->from = $site['name'].' <noreply@'.$site['domain'].'>';
			$this->Email->subject = 'Mensaje enviado desde '.ucfirst($site['domain']);
			$this->Email->delivery = 'mail';
			$this->Email->sendAs = 'html';
			$this->Email->template = 'contact';

			if(Configure::read('debug')===0){
				if($this->Email->send()){
					$msg = 'Su mensaje ha sido enviado correctamente. ¡Gracias por contactar con nosotros!';
				}
				else
					$msg = 'Lo sentimos, pero hubo un problema al enviar el mensaje.';
			} else {
				$this->Email->delivery = 'debug';
				$this->Email->send();
				$msg = 'El Formulario ha sido desactivado porque está en modo Demo.';
			}

			$this->set('successmsg',$msg);
		} else
			$this->set('errors',$this->Contact->invalidFields());

		$this->set('fid',$this->params['url']['fid']);
		$this->render('form');
	}
}
?>