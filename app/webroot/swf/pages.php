<?='<?xml version="1.0" encoding="UTF-8" ?>'?>
<FlippingBook>
	<width>650</width>
	<height>423</height>
	<scaleContent>true</scaleContent>
	<firstPage>0</firstPage>
	<alwaysOpened>false</alwaysOpened>
	<autoFlip>100</autoFlip>
	<flipOnClick>false</flipOnClick>
	<shadowsDepth>1</shadowsDepth>
	<moveSpeed>2</moveSpeed>
	<closeSpeed>3</closeSpeed>
	<gotoSpeed> 3 </gotoSpeed>
	<flipSound>01.mp3</flipSound>
	<pageBack>0xFFF5EC</pageBack>
	<loadOnDemand>true</loadOnDemand>
	<cachePages>true</cachePages>
	<usePreloader>true</usePreloader>
	<pages>
	<?
		foreach($pages as $page)
			echo '<page>http://'.$_SERVER['SERVER_NAME'].'/'.$page['Magazineimg']['src'].'</page>';
	?>
	</pages>
</FlippingBook>