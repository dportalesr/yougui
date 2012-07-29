<?php
App::import('Controller','_base/Imgs');
class ServiceimgsController extends ImgsController{
	var $name = 'Serviceimgs';
	var $pageTitle = 'Fotos';
	var $uses = array('Serviceimg','Service');
}
?>