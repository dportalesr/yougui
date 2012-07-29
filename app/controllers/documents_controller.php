<?php
App::import('Controller','_base/Categorizeditems');
class DocumentsController extends CategorizeditemsController{
	var $name = 'Documents';
	var $uses = array('Document','Category');
	
	function download($id = false){
		$id = $this->_checkid($id,false);
		$this->m[0]->recursive = -1;
		$file = $this->m[0]->read(null,$id);
		
		if($file && isset($file[$this->uses[0]]['src']) && $file[$this->uses[0]]['src']){
			$f = pathinfo($file[$this->uses[0]]['src']);
			$filename = ucfirst(Inflector::slug(_dec($file[$this->uses[0]]['nombre'])));
			$params = array(
				'download' => true,
				'id' => $f['basename'],
				'name' => $filename,
				'extension' => $f['extension'],
				'mimeType' => array(
					'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
					'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
					'rar'=>'application/x-rar-compressed'
				),
				'path' => WWW_ROOT .'docs' . DS
			);

			if(file_exists($params['path'].$params['id'])!== false){
				$this->view = 'Media';
				$this->autoLayout = false;
				$this->set($params);
				$this->render();
				exit;
			}
		}

		$this->redirect($this->referer());
	}
}
?>