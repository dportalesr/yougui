<?php
class ResizeHelper extends Helper {
/**
* 04/Mar/2010 - Compatibilidad para abrir Thumbnails de Youtube y poner el ID del video en el nombre de archivo evitando sobreescritura (0.jpg).
* 23/Mar/2010
*	- Revisión general.
*	- Fix para los hostings con allow_url_fopen desactivado (Youtube thumbnails).
* 26/Mar/2010 - Revisión de las rutas.
* 07/Mar/2011 - Parámetros como array y agregada la opción Fill: Las dimensiones especificadas funcionan como mínimas.
*/
	var $helpers = array('Html');
	var $cacheDir = 'cache';

/**
* Automatically resizes an image and returns formatted IMG tag
*
* @param string $url Path to the image file, relative to the webroot/img/ directory.
* @param integer $opts['w'] Image of returned image
* @param integer $opts['h'] Height of returned image
* @param boolean $opts['aspect'] Maintain aspect ratio (default: true)
* @param array $opts['atts'] Array of HTML attributes.
* @param boolean $opts['urlonly'] Restituisce solamente l'url invece dell'immagine completa
* @param boolean $return Wheter this method should return a value or output it. This overrides AUTO_OUTPUT.
* @return mixed Either string or echos the value, depends on AUTO_OUTPUT and $return.
* @access public
*/
	function resize($url, $opts = array()) {
		$defaults = array(
			'w'=>'',
			'h'=>'',
			'fill'=>false,
			'aspect'=>true,
			'atts'=>array(),
			'urlonly'=>false
		);
		$opts = am($defaults,$opts);

		if(!($opts['w'] || $opts['h'])){ $this->log(array($url,$opts),'resize_error'); return false; }

		$types = array(1 => 'gif', 'jpeg', 'png', 'swf', 'psd', 'wbmp'); // used to determine image type
		$dimens = $opts['w'].'x'.$opts['h'];

		$cachePath = WWW_ROOT.$this->cacheDir;
		
		$percorso = $cachePath.DS.$dimens;
		if(!is_dir($percorso)){
			mkdir($percorso);
			chmod($this->cacheDir.DS.$dimens,0777);
		}

		$filename = basename($url);
		
		if($isExternal = (stripos($url,'http') === 0)){
			$temp = parse_url($url);
			if(stripos($temp['host'],'youtube') !== false){ # Fix for youtube 0.jpg thumbs
				list(,,$filename,) = explode('/',$temp['path']);
				$filename.= low(strrchr($temp['path'],'.'));
			}
			$localFile = $cachePath.DS.$filename;
			if(!file_exists($localFile)){ # TODO: Agregar 1 Hr de cache si el archivo existe
				$curl = curl_init($url);
				$fh = fopen($localFile, "w");
				curl_setopt ($curl, CURLOPT_FILE, $fh);
				curl_setopt ($curl, CURLOPT_HEADER, 0);
				curl_exec ($curl);
				curl_close ($curl);
				fclose ($fh);
				chmod($localFile,0777);
			}
			
			$url = $this->cacheDir.'/'.$filename;
		}
		
		$originalPath = WWW_ROOT.str_replace(array('/', '\\'), DS,$url);
		$cachedPath = $percorso.DS.$filename;
		$cachedUrl = $this->cacheDir.'/'.$dimens.'/'.$filename;
		$omitResize = false;
		
		/*/
		fb($isExternal,'isExternal');
		fb($url,'$url');
		fb($filename,'$filename');
		fb($cachedPath,'$cachedPath');
		fb($cachedUrl,'$cachedUrl');
		/**/
	
		if (!($size = @getimagesize($originalPath))){ return ''; }

		/// Solo se especifica ancho ó alto y coincide con la original, omite resize
		if(($opts['w'] == $size[0] && (!$opts['h'])) || ($opts['h'] == $size[1] && (!$opts['w']))){
			$omitResize = true;

		} else {
			if($opts['aspect']){ // adjust to aspect
				if((!$opts['w']) || ($opts['h'] && ($size[1]/$opts['h']) > ($size[0]/$opts['w']))){ // $size[0]:width, [1]:height, [2]:type
					if($opts['fill'] && $opts['w']) {
						$opts['h'] = ceil($opts['w'] / ($size[0]/$size[1]));
					} else {
						$opts['w'] = ceil(($size[0]/$size[1]) * $opts['h']);
					}

				} elseif((!$opts['h']) || ($opts['w'] && ($size[1]/$opts['h']) < ($size[0]/$opts['w']))){ // $size[0]:width, [1]:height, [2]:type
					if($opts['fill'] && $opts['h']){
						$opts['w'] = ceil(($size[0]/$size[1]) * $opts['h']);
					} else {
						$opts['h'] = ceil($opts['w'] / ($size[0]/$size[1]));
					}
				}
			}
		}
	
		if(file_exists($cachedPath)) {
			$csize = @getimagesize($cachedPath);
			$cached = ($csize[0] == $opts['w'] && $csize[1] == $opts['h']); // image is cached
			if (@filemtime($cachedPath) < @filemtime($url)) // check if up to date
				$cached = false;
		} else {
			$cached = false;
		}

		$resize = (!$cached) && (!$omitResize) ? (($size[0] > $opts['w'] || $size[1] > $opts['h']) || ($size[0] < $opts['w'] || $size[1] < $opts['h'])) : false;

		if ($resize) {
			$image = call_user_func('imagecreatefrom'.$types[$size[2]], $originalPath);
			#fb($image,'Image created from (url) '.$url);
			if (function_exists('imagecreatetruecolor') && ($temp = imagecreatetruecolor ($opts['w'], $opts['h']))){
				@imagecopyresampled ($temp, $image, 0, 0, 0, 0, $opts['w'], $opts['h'], $size[0], $size[1]);
			} else {
				if($temp = @imagecreate($opts['w'], $opts['h'])){
					@imagecopyresized($temp, $image, 0, 0, 0, 0, $opts['w'], $opts['h'], $size[0], $size[1]);
				}
			}

			if(in_array($types[$size[2]],array('jpg','jpeg'))){
				call_user_func('image'.$types[$size[2]], $temp, $cachedPath, 100);
			}else{
				call_user_func('image'.$types[$size[2]], $temp, $cachedPath);
			}
			#fb($cachedPath,'Image created to ($cachedPath)');
			@chmod($cachedPath,0777);
			@imagedestroy ($image);
			@imagedestroy ($temp);
		} elseif(!$cached){
			$cachedUrl = $url;
		}
		
		if(strpos($cachedUrl,'/')=== 0) # Fix no resized, full urls and others
			$cachedUrl = substr($cachedUrl,1);

		$cachedUrl = $this->webroot.$cachedUrl;
		
		if ($opts['urlonly'] != true)
			$output = sprintf($this->Html->tags['image'], $cachedUrl, $this->Html->_parseAttributes($opts['atts'],null,'',' '));
		else
			$output = $cachedUrl;
		
		/// fb($output,'output');
		return $output;
	}
}
?>