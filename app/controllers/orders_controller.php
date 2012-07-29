<?php
App::import('Controller','_base/Items');
class OrdersController extends ItemsController{
	var $name = 'Orders';
	var $uses = array('Order');
}
?>