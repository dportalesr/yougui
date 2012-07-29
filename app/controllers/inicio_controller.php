<?php
App::import('Controller','_base/My');
class InicioController extends MyController {
	var $name = 'Inicio';
	var $uses = array('Carousel');

	function index(){
		$carrusel = $this->Carousel->find_();
		$this->set(compact('carrusel'));

		$this->pageTitle = Configure::read('Site.slogan');
		
	}
	
	function email(){ $this->layout = 'empty'; }
	function invitar(){
		$site = Configure::read('Site');
		
		if(!empty($this->data)){
			$this->Invitacion->set($this->data);
			if($this->Invitacion->validates()){
				$data = array_merge($this->data['Invitacion'],array('domain'=>$site['domain'],'business'=>$site['name']));
				$this->Invitacion->clean($data,false,false);
				$this->set($data);

				//// Send
				$this->Email->to = $data['nombre_para'].' <'.$data['email_para'].'>';
				$this->Email->from = $data['nombre_de'].' <'.$data['email_de'].'>';
				$this->Email->subject = $data['nombre_de'].' te ha invitado a visitar '.ucfirst($site['name']);
				$this->Email->replyTo = 'noreply@'.$site['domain'];
				$this->Email->sendAs = 'html';
				$this->Email->template = 'invite';
				
				if(Configure::read('debug')===0){
					if($this->Email->send())
						$msg = 'Tu invitación fue enviada correctamente.';
					else
						$msg = 'Lo sentimos. Hubo un problema al enviar tu invitación. Intenta de nuevo dentro de unos minutos.';
				} else 
					$msg = 'El Formulario ha sido desactivado porque está en modo Demo.';

				$this->set('successmsg',$msg);
			} else
				$this->set('errors',$this->Invitacion->invalidFields());

			$this->set('fid',$this->params['url']['fid']);
			$this->set('model','Invitacion');
			$this->render('form');
		} else
			$this->render('/inicio/invitar');
	}
}
?>