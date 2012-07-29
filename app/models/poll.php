<?php
class Poll extends AppModel {
	var $name = 'Poll';
	var $belongsTo = array(
		'Category'=>array('className' => 'Category'),
		'Pcategory' => array(
			'className' => 'Category',
			'foreignKey' => false,
			'conditions' => 'Pcategory.id = Category.parent_id'
		)
	);
	var $labels = array('category_id'=>'Programa');
	var $hasMany = array(
		'Question'=>array(
			'classname' => 'Question',
			'dependent' => true
		),
		'Visitor' => array(
			'className' => 'Visitor',
			'foreignKey'=>'item_id',
			'conditions'=>array('Visitor.item'=>'Poll')
		)
	);
	var $validate = array();
	
	function afterSave($created){
		$item = $this->read(array('activo','category_id'),$this->id);
		if(isset($item[$this->alias]['activo']) && $item[$this->alias]['activo']){
			$this->updateAll(array($this->alias.'.activo'=>0),array($this->alias.'.id <>' => $this->id, $this->alias.'.category_id' => $item[$this->alias]['category_id']));
		}
		parent::afterSave($created);
	}
}
?>