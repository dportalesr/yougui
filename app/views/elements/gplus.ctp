<?php
$mode = isset($mode) && $mode ? $mode : 'h';
$prefix = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 's':'').'://'.Configure::read('Site.domain');
$url = isset($url) ? (strpos($url, '/')===0 ? $prefix.$url : $url) : $prefix.$_SERVER['REQUEST_URI'];

$g_config = array('data-size'=>'medium','data-annotation'=>'inline','data-href'=>$url);
if($mode == 'v'){ $g_config = array('data-size'=>'tall'); }
$g_config['data-width'] = 120;

echo $html->div('gplus',$html->div('g-plusone','',$g_config));
