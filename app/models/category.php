<?php
class Category extends AppModel {
	var $name = 'Category';
	var $hasMany = array('Product');
	var $actsAs = array('Tree');
	var $asTree = true;

}
?>