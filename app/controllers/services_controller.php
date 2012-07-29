<?php
App::import('Controller','_base/Unlisteditems');
class ServicesController extends UnlisteditemsController{
	var $name = 'Services';
	var $uses = array('Service','Serviceimg');
}
?>