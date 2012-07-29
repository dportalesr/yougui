<?php
App::import('Controller','_base/Labels');
class CategoriesController extends LabelsController {
	var $name = 'Categories';
	var $uses = array('Category');
}
?>