<?php
App::import('Controller','_base/Items');
class VideosController extends ItemsController{
	var $name = 'Videos';
	var $uses = array('Video','Comment');
	var $paginate = array('Video'=>array('limit' => 8));
}
?>