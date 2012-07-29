<?php
App::import('Controller','_base/Labels');
class QuestionsController extends LabelsController {
	var $name = 'Questions';
	var $uses = array('Question');
}
?>