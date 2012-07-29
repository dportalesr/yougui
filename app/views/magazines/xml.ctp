<?php
	echo '<?xml version="1.0" encoding="utf-8"?>';
	$w = $h = 0;
	if($items){
		$nitems = sizeof($items);
		for($i=0;$i<$nitems;$i++){
			if($size = @getimagesize('./'.$items[$i]['Magazineimg']['src'])){
				list($w,$h) = $size;
				break;
			}
		}
	}
?>
<!DOCTYPE book SYSTEM "http://www.megazine3.de/megazine2.dtd">
<book plugins="batchpages, console, gallery, help, javascript, keyboardnavigation, links, navigationbar, options, overlays, pdflinks, print, slideshow, swfaddress, titles"
	bgcolor="0xbba978" dragrange="80" pagewidth="<?=$w?>" pageheight="<?=$h?>" lang="es" reflection="false" maxscale="4" minscale="0.25" searchhighlight="true">
	<chapter>
<?php
	if($items){
		foreach($items as $item)
			echo "\t\t".'<page><img src="/'.$item['Magazineimg']['src'].'" width="'.$w.'" height="'.$h.'" ></img></page>'."\n";
	}
?>
	</chapter>
</book>
