<?php
App::import('Controller','_base/Items');
class AlbumsController extends ItemsController{
	var $name = 'Albums';
	var $pageTitle = 'Galería de Fotos';
	var $uses = array('Album','Albumimg','Comment');
}
?>