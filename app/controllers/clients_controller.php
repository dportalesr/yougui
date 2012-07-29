<?php
App::import('Controller','_base/Items');
class ClientsController extends ItemsController{
	var $name = 'Clients';
	var $uses = array('Client');
}
?>