<?php
App::import('Controller','_base/Items');
class LinksController extends ItemsController{
	var $name = 'Links';
	var $uses = array('Link');
}
?>