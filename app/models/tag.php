<?php
class Tag extends AppModel {
	var $name = 'Tag';
	var $actsAs = array('ExtendAssociations');
	var $hasAndBelongsToMany = array('Post');
	var $displayField = 'tag';
	
	function savehabtm($data = false, $model_id = false, $model = false){
		if(!($data && $model_id)){ return; }
		if(!$model){
			$model = array_keys($this->hasAndBelongsToMany);
			$model = $model[0];
		}
		
		$with = $this->hasAndBelongsToMany[$model]['with'];
		$jointable = $this->hasAndBelongsToMany[$model]['joinTable'];
		
		$all = $this->find('list',array('fields'=>array('id','tag')));//fb($all,'$all');
		$this->clean($all,true);

		if(!(isset($data['Tag']) && $data['Tag'])){ $data['Tag'] = array(); }
		
		$existing = $data['Tag'];
		$new = isset($data['addTag']) && $data['addTag'] ? $data['addTag'] : false;
		$data = array();
		
		/// Tags actuales del elemento
		$current = $this->{$with}->find('list',array('fields'=>array('id','tag_id'),'conditions'=>array(low($model).'_id' => $model_id)));//fb($current,'$current');
		
		/// Tags actuales que no se mantuvieron: eliminar
		if($delete = array_diff($current,$existing)){//fb($delete,'$delete');
			$this->{$with}->deleteAll(array('id'=>array_keys($delete)),true,true);
			$conds = array('NOT EXISTS (SELECT * FROM '.$jointable.' WHERE Tag.id = '.$jointable.'.tag_id) AND Tag.id IN ('.implode(',',$delete).')');
			$this->deleteAll($conds,true,true);
		}
		
		//Las nuevas tags
		if($new){//fb($new,'$new');
			foreach($new as $tag){
				$tag = trim($tag);
				if($tag && !in_array($tag,$all)){
					$this->create(); // limpiar el id
					$this->save(array(
						'Tag'=>array('tag'=>$tag),
						$model => array('id'=>$model_id)
					));
				}
			}
		}

		/// Tags que se recibieron y existen pero aún no están asociadas al post: solo relacionar.
		if($bind = array_diff($existing,$current)){//fb($bind,'$bind');
			foreach($bind as $tag){
				$this->{$with}->create(); // limpiar el id
				$this->{$with}->save(array('tag_id'=>$tag,low($model).'_id'=>$model_id));
			}
		}
	}
}
?>