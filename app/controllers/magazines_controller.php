<?php
App::import('Controller','_base/Items');
class MagazinesController extends ItemsController{
	var $name = 'Magazines';
	var $uses = array('Magazine','Magazineimg');

	function xml($id) {
		$this->layout = 'empty';
		$id = $this->_checkid($id,false);
		$items = $this->{$this->uses[0].'img'}->find_(array(
			'conditions'=>array(strtolower($this->uses[0]).'_id'=>$id),
			'order'=>$this->uses[0].'img.orden ASC',
			'contain'=>false
		));
		$this->set(compact('items'));
	}

	function hojear($id = false) {
		$id = $this->_checkid($id, false);
		
		$this->layout = 'magazine';
		$this->m[0]->recursive = -1;
		if($item = $this->m[0]->read(array('nombre'),$id)){
			$this->set('mid',$id);
			$this->pageTitle = $item[$this->uses[0]]['nombre'];
		}

	}
	
	function admin_export() {
		$this->_export(array(
			'nombre'=>'Nombre',
			'activo'=>'Activo',
			$this->uses[0].'img_count'=>'Páginas'
		));
	}
}
?>