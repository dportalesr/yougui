<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Panel | <?=$title_for_layout?> | <?=$sitename_for_layout?></title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="Title" content="<?=$sitename_for_layout?>" />
<meta name="Author" content="Pulsem" />
<meta name="Generator" content="daetherius" />
<meta name="Language" content="Spanish" /> 
<meta name="Robots" content="noindex,nofollow" />
<?=$html->css(array('generic','admin','pulsembox'))?> 
</head>
<body class="admin">
<?php
echo
	$html->div('nofooter'),
		$html->div('header'),
			$html->link('Cerrar Sesión',array('admin'=>1,'controller'=>'users','action'=>'logout'),array('class'=>'logout','title'=>'Finalizar sesión como administrador','escape'=>false)),
			$html->link($html->image('admin/logo.jpg',array('alt'=>$sitename_for_layout)),'/',array('id'=>'logo','title'=>'Ir al Inicio')),
			$html->tag('span','Panel de Administración',array('id'=>'title')),
		'</div>';
			
	if(isset($sAdmin) && $sAdmin){

		echo $html->div('sidebar');
			$modules = Configure::read('Modules');
			foreach($modules as $cntrllr => $mod){
				if(isset($mod['admin']) && $mod['admin']){
					echo $html->link($html->tag('span',ucfirst($mod['admin']['label']), array('class'=>$mod['admin']['class'])),array('controller'=>$cntrllr, 'action'=>'index','admin'=>true),array('class'=>array_key_exists('br', $mod) ? 'withbreak':''));
				}
			}

			echo $html->div('support'),
				$html->para('title','Asesoría en Línea');
				
				if(Configure::read('debug')==0){
					echo
						$html->tag('iframe','',array(
							'src'=>'http://www.google.com/talk/service/badge/Show?tk=z01q6amlqo370i1lpr8vhau44l5hq29li7r3k6rv7g6vetoiflv703cuhs5i8366avel3es3g0cjk6aoua15tb59qoc9aq5haf0e8udv9rgjfa9nqnphqt08g9plu6lhac8m8lltmustclvkd5mfml5hr9dl7t2uitvhcahrvc484413il0ofvni4r02un12c3k&amp;w=180&amp;h=60',
							'width'=>180,
							'frameborder'=>'0',
							'allowtransparency'=>'true'
						)),
						$html->tag('iframe','',array(
							'src'=>'http://www.google.com/talk/service/badge/Show?tk=z01q6amlqvcbpo2nfjaaptc0tuvsruqms559jc0srevoqd37s8hoveeontj5ashdm5k7bspmh1l7sk0rqj5kdt8osngujhflkis6src2furgf3fair38r1e5vdi3h3368ahgsvpt1d4uvs4g2bk2ugj5r2k5t3e44jjn1m4qqthm8ttc4qvlreo2ql64rj3cgrg&amp;w=180&amp;h=60',
							'width'=>180,
							'frameborder'=>'0',
							'allowtransparency'=>'true'
						));
				}
				
			echo '</div>',
		'</div>';
	}

	echo
		$html->div('content'.(isset($sAdmin) && $sAdmin ? ' logged':''), $this->element('flash').$content_for_layout),
		$html->div('cleaner',''),
	'</div>',
	$html->div('footer'),
		$html->link('','http://pulsem.mx',array('id'=>'pulsem','title'=>'Web + Identidad + Consultoría')),
		$html->para('','Web | Identidad | Consultoría'),
	'</div>',

	///////	

	$html->script(array('moo13','moo13m','utils','pulsembox')),
	$scripts_for_layout,
	$moo->writeBuffer(array('onDomReady'=>false)),
	$moo->highlight($highlight,1);
?>
</body>
</html>