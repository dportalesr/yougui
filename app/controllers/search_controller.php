<?php
App::import('Controller','_base/My');
class SearchController extends MyController{
	var $name = 'Search';
	var $uses = array('Search');
	var $paginate = array(
		'Search'=>array('limit' => 10)
	);

	function index() {
		$this->redirect('resultados');
	}
	function resultados() {
		$this->set('items',false);
		
		if(isset($this->data)){
			if($this->data['Search']['q']){
				$redirect = array('q'=>b64($this->data['Search']['q']));
				
				if(isset($this->data['Search']['tipo']) && $this->data['Search']['tipo'])
					$redirect['tipo'] = $this->data['Search']['tipo'];
				
				$this->redirect($redirect);
				exit;
			}
		} else {
			if(isset($this->params['named']['q'])){
				$q = b64($this->params['named']['q'],1);
				$paginateconditions = array('q'=>$q);
				
				if(isset($this->params['named']['tipo']) && $this->params['named']['tipo']){
					$paginateconditions['tipo'] = $this->params['named']['tipo'];
					$this->data['Search']['tipo'] = $this->params['named']['tipo'];
				}
					
				$items = $this->paginate('Search',$paginateconditions);
				$this->set(compact('items'));
				$this->data['Search']['q'] = $q;
				
			}
		}
	}	
}
?>
