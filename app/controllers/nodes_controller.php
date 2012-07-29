<?php
App::import('Controller','_base/Items');
class NodesController extends ItemsController {
	var $name = 'Nodes';
	var $uses = array('Node','Nodeimg');

	function index(){
		if($nodes = $this->m[0]->children(NULL,true,NULL,$this->uses[0].'.orden desc, '.$this->uses[0].'.id desc',null,null,-1)){
			$this->redirect(array('action'=>'ver',$nodes[0]['Node']['slug']));exit;
		}

		$this->set('items',false);
	}

	function ver($id = false){
		$path = $root = false;
		$id = $this->_checkid($id);

		$this->m[0]->recursive = 1;

		if($item = $this->m[0]->read(null,$id)){
			/* Forzar redireccionamiento a páginas hijas
			if(is_null($item['Node']['parent_id'])){
				if($item = $this->m[0]->find_(array('contain'=>false,'conditions'=>array('Node.parent_id'=>$item['Node']['id'])),'first')){
					$this->redirect(array('action'=>'ver','id'=>$item['Node']['slug']));exit;
				} else {
					$this->redirect(array('action'=>'index'));exit;
				}
			}
			#/*/

			$path = $this->m[0]->getpath($id, array('id','parent_id','nombre','slug'));
			$root = $path[0];
		
		} else {
			$this->redirect(array('action'=>'index'));exit;
		}

		$this->set(compact('path','root','item'));
	}

	function admin_index($id = false) {
		$this->set('path', $id ? $this->m[0]->getpath($id):array());
		$this->set('parent',$id);

		$orderdata = $this->m[0]->children($id,true,NULL,$this->uses[0].'.orden desc, '.$this->uses[0].'.id desc',null,null,-1);
		$this->m[0]->clean($orderdata,true);
		$this->set(compact('orderdata'));

		///

		if(empty($this->data)){
			if($id){
				$this->m[0]->recursive = -1;
				$this->data = $this->m[0]->read(null,$id);
				$this->m[0]->clean($this->data,true);
			}

			$this->data[$this->uses[0]]['layout'] = 'Derecha';

		} else {
			$parent = false;
			if(isset($this->data[$this->uses[0]]['parent_id'])){
				$parent = $this->data[$this->uses[0]]['parent_id'];
				unset($this->data[$this->uses[0]]['parent_id']);
			}
			
			/// Saving the childs (OMG, Will someone please think of the children?!)
			foreach($this->data[$this->uses[0]] as $k => $it ){
				if(is_numeric($k)){
					if($parent) $it['parent_id'] = $parent;
					
					$this->m[0]->create(false);
					$this->m[0]->save($it);
					unset($this->data[$this->uses[0]][$k]);
				}
			}
			
			if(isset($this->data[$this->uses[0]]['enlace']) && empty($this->data[$this->uses[0]]['enlace']))
				$this->data[$this->uses[0]]['externo'] = 0;
			
			if($this->data[$this->uses[0]]){
				$this->m[0]->create(false);
				
				if(!$this->m[0]->saveAll($this->data,array('validate'=>true))){
					$this->_flash('save_fail');
					$this->redirect(array('action'=>'index','admin'=>1,$parent));
					exit;
				}
			}

			$this->_flash('save_ok');
			$this->redirect(array('action'=>'index','admin'=>1,$parent));

		} #exit;
	}
	
	/*
	function admin_images($id = false){
		$id = $this->_checkid($id);
		$this->paginate[$this->uses[0].'img'] = array('limit'=>16,'order'=>$this->uses[0].'img.id desc');
		
		if($id = (int)$id){
			$this->set('items',$this->paginate($this->uses[0].'img',array($this->uses[0].'img.'.(low($this->uses[0])).'_id'=>$id)));
			$this->set('itemtitle',$this->m[0]->field($this->m[0]->displayField,array('id'=>$id)));
		}
			
		if(!empty($this->data)){
			if($return = $this->m[0]->saveAll($this->data,array('validate'=>true))){
				$msg = 'ok';
				if(is_array($return) && in_array(false,$return,true)){ $msg = 'some'; }
				$this->_flash('save_'.$msg);
				$this->redirect(am($this->passedArgs,array('action'=>'index','admin'=>1)));
			}		
		}
	}	

	function admin_delete($id,$sortable){
		$script = 'alert("Error al eliminar")';
		if($id = (int)$id){
			if($this->m[0]->delete($id))
				$script = '$("elistitem_'.$id.'").nix().get("reveal").chain(function(){ '.$sortable.'Sortable.reorder(); });';
		}
		$this->set('ajax',$script);
		$this->render('js');
	}
	*/
}
?>