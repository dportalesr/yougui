<?php
App::import('Controller','_base/Items');
class FaqsController extends ItemsController {
	var $name = 'Faqs';
	var $uses = array('Faq');

	function index() { parent::index(false); }
}
?>