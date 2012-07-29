<?php
App::import('Controller','_base/Imgs');
class MagazineimgsController extends ImgsController{
	var $name = 'Magazineimgs';
	var $uses = array('Magazineimg','Magazine');
}
?>