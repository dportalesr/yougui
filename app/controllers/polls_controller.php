<?php
App::import('Controller','_base/Items');
class PollsController extends ItemsController{
	var $name = 'Polls';
	var $uses = array('Poll','Question','Answer');

	function admin_respuestas($parent = false){
		if($parent = $this->_checkid($parent,false)){
			$question = $this->Question->find_(array($parent,'contain'=>false));
			$this->set('pollquestion',$question['Question']['nombre']);
			$this->set('pollid',$question['Question']['poll_id']);
		} else {
			$this->redirect($this->referer());
		}
		
		if(empty($this->data)){
			$this->set('orderdata',$this->Answer->find_(array(
				'conditions'=>array('question_id'=>$parent),
				'fields'=>array('id',$this->Answer->displayField,'votos','orden'),
				'contain'=>false,
			),'all+'));
		} else {
			$success = true;
			foreach($this->data['Answer'] as $it){
				if($parent) $it['question_id'] = $parent;
				$this->Answer->create(false);
				$success = $success && $this->Answer->save($it);
			}
			$this->_flash('save_'.($success ? 'ok':'some'));
		}
	}

	function vote() {
		$question = $answer = false;
		$isAjax = isset($this->params['isAjax']) && $this->params['isAjax'];
		
		if(isset($this->data['Question']) && $this->data['Question']){
			if(isset($this->data['Question']['ids']) && $this->data['Question']['ids']){
				reset($this->data['Question']['ids']);
				list($qid,$aid) = explode('_',key($this->data['Question']['ids']));
			} else {
				$qid = $this->data['Question']['qid'];
				$aid = $this->data['Question']['aid'];
			}

			if($qid)
				$question = $this->Poll->Question->find_(array($qid,'contain'=>array('Poll')));

			if($aid)
				$answer = $this->Poll->Question->Answer->find_(array($aid,'contain'=>false));
		}
		
		$ip = inet_ptod($this->RequestHandler->getClientIP());
		
		/// No ha contestado previamente la pregunta
		if($question && $answer && (!$this->Poll->Visitor->find_(array('conditions'=>array('ip'=>$ip,'item'=>'Question','item_id'=>$qid)),'count'))){
			/// +1
			$this->Poll->Question->Answer->id = $answer['Answer']['id'];
			if($this->Poll->Question->Answer->saveField('votos',$answer['Answer']['votos']+1)){
				$this->Poll->Visitor->create(false);
				$this->Poll->Visitor->save(array(
					'ip'=>$this->RequestHandler->getClientIP(),
					'item'=>'Question',
					'item_id'=>$question['Question']['id']
				));
			}

			/// Encuesta completada
			$answered = $this->Poll->Visitor->find_(array(
				'conditions'=>array(
					'ip'=>$ip,
					'item'=>'Question',
					'Question.poll_id'=>$question['Question']['poll_id']
				),
				'contain'=>array('Question')
			),'count');

			if($answered >= $question['Poll']['question_count']){
				$this->Poll->Visitor->create(false);
				$this->Poll->Visitor->save(array(
					'ip'=>$this->RequestHandler->getClientIP(),
					'item'=>'Poll',
					'item_id'=>$question['Question']['poll_id']
				));
				/*
				*/
			}
			$ajax = 'var answered = $("question_'.$question['Question']['id'].'"); answered.getNext(".question").reveal(); answered.nix();';
			
		} else {
			$ajax = 'alert("Ha ocurrido un problema. Intente de nuevo.");';
		}

		if($this->params['isAjax']){
			$this->set(compact('ajax'));
			$this->render('js');

		} else {
			$this->redirect($this->referer());
			exit;
			
		}
	}
	
	function getresults($id,$json = false){
		$id = $this->_checkid($id);
		$questions = $this->m[1]->find_(array('conditions'=>array('poll_id'=>$id),'contain'=>false));
		
		if($json){
			$resultsData = array();
			foreach($questions as $opt)
				$resultsData[] = $opt[$this->uses[1]]['id'].':'.$opt[$this->uses[1]]['votos'];
			return '{'.implode(',',$resultsData).'}';
			
		}else{
			$resultsData = '';
			$total = 0;
			
			foreach($questions as $opt)
				$total+= $opt[$this->uses[1]]['votos'];
			
			if($total > 0)
				foreach($questions as $opt)
					$resultsData.= $opt[$this->uses[1]]['opcion'].' = '.$opt[$this->uses[1]]['votos'].' ('.(round($opt[$this->uses[1]]['votos']/$total*100,1)).'%)<br/>';
			else
				$resultsData = '"No hay votos aún"';
				
			return $resultsData;
		}
	}
}
?>