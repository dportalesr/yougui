<?php
App::import('Controller','_base/Imgs');
class NodeimgsController extends ImgsController{
	var $name = 'Nodeimgs';
	var $uses = array('Nodeimg','Node');
}
?>