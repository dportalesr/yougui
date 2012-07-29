<?php
App::import('Controller','_base/Imgs');
class ProductimgsController extends ImgsController{
	var $name = 'Productimgs';
	var $uses = array('Productimg','Product');
}
?>