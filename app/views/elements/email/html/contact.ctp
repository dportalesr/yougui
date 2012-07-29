<div style="padding:15px;border:#CCC solid 1px;margin:0;margin-top:10px;">
	<h1 style="font-weight:normal;font-size:24px;margin:0;margin-bottom:18px;color:#444">Mensaje desde <?=Configure::read('Site.domain')?></h1>
	<p><strong>Nombre: </strong><?=$nombre?></p>
	<p><strong>Email: </strong><?=$email?></p>
	<?
	if(isset($empresa) && $empresa) echo $html->tag('p','<strong>Empresa: </strong>'.$empresa);
	if(isset($telefono) && $telefono) echo $html->tag('p','<strong>Teléfono: </strong>'.$telefono);
	if(isset($servicios) && $servicios) echo $html->tag('p','<strong>Interesado en: </strong>'.implode(', ',$servicios));
	if($mensaje){
		echo $html->tag('p','<strong>Mensaje: </strong>');
		echo $html->div(null,$mensaje,array('style'=>'background:#F6F6F6;padding:10px;margin-bottom:8px;'));
	}
	?>
</div>