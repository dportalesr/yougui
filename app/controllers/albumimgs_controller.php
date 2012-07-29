<?php
App::import('Controller','_base/Imgs');
class AlbumimgsController extends ImgsController{
	var $name = 'Albumimgs';
	var $uses = array('Albumimg','Album');
}
?>