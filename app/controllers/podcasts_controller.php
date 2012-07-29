<?php
App::import('Controller','_base/Items');
class PodcastsController extends ItemsController{
	var $name = 'Podcasts';
	var $uses = array('Podcast','Comment');
	
	function admin_editar($id) {
	   $id = $this->_checkid($id);
	   if(empty($this->data))
			 $this->set('podcast',$this->m[0]->field('src',array('id'=>$id)));
			 
	   parent::admin_editar($id);
	}
}
?>