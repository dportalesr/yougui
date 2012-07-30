<?php
$wide = isset($wide) && $wide ? 'wide':'';
$sub = isset($sub) ? $sub : false;

if(isset($header)){
	if(!$header){
		$header = '';
	
	} elseif(is_string($header)) {
		$header = $html->div('sectionHdr',$header);
	
	} elseif(is_array($header)) {
		$text = $header['text'];
		unset($header['text']);
		$header = $html->div('sectionHdr',$html->link($text,$header));
	}
} else {
	$header = $html->div('title title2',$_ts);
}

echo
	$html->div('content'.$wide),
	$html->div('pad'),
	$header;

if($sub){
	echo
		$html->div('clear'),
		$html->div('nosubsidebar');
}
?>