<?php
$mode = isset($mode) && $mode ? $mode : 'h';
$prefix = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 's':'').'://'.Configure::read('Site.domain');
$url = isset($url) ? (strpos($url, '/')===0 ? $prefix.$url : $url) : $prefix.$_SERVER['REQUEST_URI'];

$w = isset($w) && $w ? $w : (strtolower($mode) == 'h' ? 120 : 70);
$h = isset($h) && $h ? $h : (strtolower($mode) == 'h' ? 21 : 65);
?>
<div class="facebook">
<iframe
	src="http://facebook.com/plugins/like.php?href=<?=urlencode($url)?>&amp;send=true&amp;layout=<?php echo $mode == 'h' ? 'button':'box'; ?>_count&amp;width=<?php echo $w; ?>&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=<?php echo $h; ?>"
	scrolling="no"
	frameborder="0"
	style="border:none; overflow:hidden;display:block;"
	allowTransparency="true"
	width="<?php echo $w; ?>"
	height="<?php echo $h; ?>"
	
></iframe>
</div>