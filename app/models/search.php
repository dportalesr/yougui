<?php
class Search extends AppModel {
	var $name = 'Search';
	var $_schema = array('q' =>array('type'=>'string', 'length'=>255));
	var $useTable = false;
	var $matches = array(
		'Album',
		'Event',
		'Post',
		'Trip',
		'Tip',
		'Supplier',
		'Magazine',
		'Wedding'=>array('nombre','descripcion','fotografo','vestido','ceremonia','banquetero')
	);
	var $validate = array(
		'q' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => 'Escriba el término de búsqueda'
		)
	);

	/**
	 * Overridden paginateCount method
	 */
	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		return count($this->paginate($conditions,null,null,null,null,$recursive,$extra));
	}
	
	function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
		$recursive = -1;
		$query = '';
		
		$this->matches = Set::normalize($this->matches);

		$searcheablemodels = $this->matches;
		
		if(isset($conditions['tipo']) && $conditions['tipo'] && array_key_exists($conditions['tipo'],$this->matches)){
			$searcheablemodels = array($conditions['tipo']=>$this->matches[$conditions['tipo']]);
		}

		foreach($searcheablemodels as $modelName => $fields){
			if(!$fields)
				$fields = array('nombre','descripcion');

			foreach($fields as &$field){ $field = $modelName.'.'.$field; }
			App::import('Sanitize');
			$conds = 'MATCH('.implode(',',$fields).') AGAINST (\''.Sanitize::escape(_enc($conditions['q'])).'\') AND '.$modelName.'.activo = 1';
			
			$query[] = 'SELECT id, '.$fields[0].' nombre, '.$fields[1].' descripcion, \''.$modelName.'\' as parent, slug FROM '.Inflector::tableize($modelName).' AS '.$modelName.' WHERE '.$conds;
		}
		
		$query = 'SELECT * FROM (('.implode(') UNION (',$query).')) as Result '.($page && $limit ? 'LIMIT '.(($page-1)*$limit).', '.$limit:'');
		
	    return $this->query($query);
	}
}
?>