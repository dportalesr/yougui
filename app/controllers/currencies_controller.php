<?php
App::import('Controller','_base/Items');
class CurrenciesController extends ItemsController{
	var $name = 'Currencies';
	var $uses = array('Currency');
}
?>