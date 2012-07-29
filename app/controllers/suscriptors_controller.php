<?php
App::import('Controller','_base/Items');
class SuscriptorsController extends ItemsController{
	var $name = 'Suscriptors';
	var $uses = array('Suscriptor');
	var $paginate = array('Suscriptor'=>array('limit' => 20));
	
	function admin_buscar(){
		$q = (isset($this->params['named']['q']) && !empty($this->params['named']['q']))?$this->params['named']['q']:'!';
		$campo = (isset($this->params['named']['campo']) && !empty($this->params['named']['campo']))?$this->params['named']['campo']:'email';
		if(ctype_alnum($q.$campo)){
			if(strlen($q)==1){
				$conditions = array('Suscriptor.'.$campo.' LIKE'=>"{$q}%");
				$msg = 'Mostrando resultados cuyo campo '.ucfirst($campo).' inicie con "'.$q.'"';
			}
			else {
				$conditions = array('Suscriptor.'.$campo.' LIKE'=>"%{$q}%");
				$msg = 'Mostrando resultados cuyo campo '.ucfirst($campo).' contenga "'.$q.'"';
			}
		} else {
			$msg = 'Mostrando resultados cuyo campo '.ucfirst($campo).' inicie con caracteres no alfanuméricos.';
			$conditions = array('Suscriptor.'.$campo.' REGEXP'=>"^[^a-zA-Z]");
		}
		$this->set('msg',$msg);
			
		$courses = $this->paginate('Course');
		$this->set(compact('courses'));
		$suscriptors = $this->paginate('Suscriptor',$conditions);
		$this->set(compact('suscriptors'));
		
		$this->detour('','admin_index');
	}

	function admin_index(){ $this->set('items',$this->paginate('Suscriptor')); }
	function admin_getemails(){ $this->set('ajax',implode(',',$this->m[0]->find_(array('fields'=>array('email')),'list+'))); }

	function suscribir(){
		if($this->data){
			$this->Suscriptor->set($this->data);
			if($this->Suscriptor->validates()){
				if($this->data['Suscriptor']['accion']){ # alta
					if($delSuscriptor = $this->Suscriptor->find_(array('conditions'=>array('email'=>$this->data['Suscriptor']['email']),'contain'=>false),'first+')){
						if($this->Suscriptor->delete($delSuscriptor['Suscriptor']['id']))
							$this->set('ajax', 'Su cuenta se ha dado de baja de nuestro sistema correctamente.');
						else
							$this->set('ajax','Hubo un problema al dar de baja su cuenta. Intente de nuevo más tarde.');
					} else {
						$this->set('ajax','No se ha podido completar la solicitud porque esa cuenta no se encuentra en nuestra base de datos.');
					}
				} else { # baja
					if($delSuscriptor = $this->Suscriptor->find_(array('conditions'=>array('email'=>$this->data['Suscriptor']['email']),'contain'=>false),'first+')){
						$this->set('ajax','Esa cuenta de correo ya se encuentra en nuestra base de datos.');
					} else { # nuevo suscriptor
						if($this->Suscriptor->save($this->data))
							$this->set('ajax','Tu registro está completo ¡Gracias por suscribirte!');
						else
							$this->set('ajax','Hubo un error en el registro. Intenta de nuevo más tarde.');
					}
				}
			} else {
				$this->set('errors',$this->m[0]->invalidFields());
				$this->render('form');
			}
		}
	}
	
	function admin_export(){ $this->_export('email'); }
}
?>