<div id="menu">
	<div class="bg"></div>
	<ul>
<?php
echo $html->tag('li',$html->link($html->tag('span', 'inicio'),'/'),array('class'=>($this->params['controller']=='inicio' ? 'mSelected' : '').' mInicio'));
$disabled = array('posts','franquicia','courses','contacto');
foreach(Configure::read('Modules') as $cntllr => $mod){
	if(isset($mod['menu']) && $mod['menu']){
		echo
			$html->tag('li',
				$html->link(
					$html->tag('span',$mod['menu']),
					in_array($cntllr,$disabled) ? '#':array('controller'=>$cntllr,'action'=>'index')
				),
				array('class'=>($this->params['controller'] == $cntllr ? 'mSelected' : '').' m'.ucfirst($cntllr))
			);
	}
}
?>
	</ul>
</div>