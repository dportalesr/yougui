<?php
$mode = isset($mode) && $mode ? $mode : 'h';
$title = isset($title) && $title ? _dec($title) : false;
$prefix = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 's':'').'://'.Configure::read('Site.domain');
$url = isset($url) ? (strpos($url, '/')===0 ? $prefix.$url : $url) : $prefix.$_SERVER['REQUEST_URI'];

$w = isset($w) && $w ? $w : (strtolower($mode) == 'h' ? 120 : 75);
$h = isset($h) && $h ? $h : (strtolower($mode) == 'h' ? 21 : 65);

$tweet_config = array(
	'class'=>'twitter-share-button',
	'data-count'=>$mode == 'h' ? 'horizontal':'vertical',
	'data-via'=>'pulsem',
	'data-related'=>'pulsem',
	'data-lang'=>'es',
	'data-url'=>$url
);

if($title) $tweet_config['data-text'] = $title;

echo
	$html->div('twitter'),
		$html->link('Tweet','http://twitter.com/share',$tweet_config),
	'</div>',
	$html->script('http://platform.twitter.com/widgets.js',array('inline'=>true));
?>