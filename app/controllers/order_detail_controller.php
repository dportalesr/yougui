<?php
App::import('Controller','_base/Items');
class OrderDetailsController extends ItemsController{
	var $name = 'OrderDetails';
	var $uses = array('OrderDetail');
}
?>