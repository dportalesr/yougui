<?php
App::import('Controller','_base/Labels');
class TagsController extends LabelsController{
	var $uses = array('Tag','Post');
	var $paginate = array(
		'Tag'=>array('limit' => 28),
		'PostsTag'=>array('group'=>'Post.id'),
		'Post'=>array('limit'=>12)
	);

	function ver($id = false) {
		$id = $this->_checkid($id,false);
		$items = false;

		if($id){
			$this->Tag->recursive = -1;
			$tag = $this->Tag->read(null,$id);
			$this->Post->bindModel(array('hasOne' => array('PostsTag'=>array(
				'className'=>'PostsTag',
				'foreignKey'=>false,
				'conditions'=>'Post.id = PostsTag.post_id'
			))),false);
			$items = $this->paginate('Post',$this->Post->find_(array('PostsTag.tag_id'=>$id),'paginate'));
			$this->set(compact('tag'));
		}
		
		$this->set(compact('items'));
	}
	
	function admin_agregar($addTagCount = 0) {
		if(isset($this->params['isAjax']) && $this->params['isAjax']){
			$this->set('tag',$this->data['addTag']);
			$this->set(compact('addTagCount'));
			$this->render('addtag');
		}
	}
	
	function admin_index() {
		if(empty($this->data)){
			$orderdata = $this->m[0]->find_(array('contain'=>false),'all+');
			$this->m[0]->clean($orderdata,true);
			$this->set(compact('orderdata'));
		} else {
			$success = true;
			foreach($this->data[$this->uses[0]] as $it){
				$this->m[0]->create(false);
				$success = $success && $this->m[0]->save($it);
			}
			$this->_flash('save_'.($success ? 'ok':'some'));
			$this->redirect(array('action'=>'index','admin'=>1));
		}
	}

	function with($model, $id){
		$id = $this->_checkid($id);
		$item = $this->{$model}->find_(array('contain'=>array('Tag'),'conditions'=>array($model.'.id'=>$id)),'first');
		return $item['Tag'];
	}
}
?>