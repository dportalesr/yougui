<?php
App::import('Controller','_base/Categorizeditems');
class ProductsController extends CategorizeditemsController{
	var $name = 'Products';
	var $uses = array('Product','Category');

	function admin_agregar(){
		if($this->handle_elist_optional())
			parent::admin_agregar();
	
		$currencies = $this->m[0]->Currency->find_(array(),'list');
		$this->set(compact('currencies'));
	}
	
	function admin_editar($id){

		if($this->handle_elist_optional())
			parent::admin_editar($id);
	
		$currencies = $this->m[0]->Currency->find_(array(),'list');
		$this->set(compact('currencies'));
	}

	function admin_export(){ $this->_export(array('nombre','precio','descripcion','Category.nombre')); }
}
?>