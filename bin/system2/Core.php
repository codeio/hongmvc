<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

function createThumb($filename, $newwidth, $newheight, $newfile) {
	list($width, $height) = getimagesize($filename);
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($filename);
	imagecopyresampled($thumb,$source,0,0,$x,$y,$newwidth,$newheight,$width,$height);
	imagejpeg($thumb,$newfile);
	imagedestroy($thumb);
	imagedestroy($source);
}

/**
 * 重写addslashes函数，支持数组
 */
function daddslashes($string, $force = 1) {
    if(is_array($string)) {
        $keys = array_keys($string);
        foreach($keys as $key) {
            $val = $string[$key];
            unset($string[$key]);
            $string[addslashes($key)] = self::daddslashes($val, $force);
        }
    } else {
        $string = addslashes($string);
    }
    return $string;
}

/**
 * 将 <p>123</p> 转换为 &lt;p&gt;123&lt;/p&gt;
 */
function htmlEncode($string, $encoding = 'utf-8') {
    if(strtolower($encoding) == 'gbk') $encoding = 'GB2312';
    return htmlentities($string, ENT_QUOTES, $encoding);
}

/**
 * 将 &lt;p&gt;123&lt;/p&gt; 转换为 <p>123</p>
 */
function htmlDecode($string, $encoding = 'utf-8') {
    if(strtolower($encoding) == 'gbk') $encoding = 'GB2312';
    return html_entity_decode($string, ENT_QUOTES, $encoding);
}

function trimTextarea($string) {
	$string = nl2br ( str_replace (' ', '&nbsp;', $string ) );
	return $string;
}

function executeTime() {
	$stime = explode ( ' ', SYS_START_TIME );
	$etime = explode ( ' ', microtime () );
	return number_format ( ($etime [1] + $etime [0] - $stime [1] - $stime [0]), 6 );
}

function random($length, $chars = '0123456789') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function sizeFormat($filesize) {
	if ($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
	} elseif ($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 .' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize.' Bytes';
	}
	return $filesize;
}

function fileExt($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}

function isEmail($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function isIe() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}

function fileDown($filepath, $filename = '') {
	if(!$filename) $filename = basename($filepath);
	if(is_ie()) $filename = rawurlencode($filename);
	$filetype = fileext($filename);
	$filesize = sprintf("%u", filesize($filepath));
	if(ob_get_length() !== false) @ob_end_clean();
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Encoding: none');
	header('Content-type: '.$filetype);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-length: '.$filesize);
	readfile($filepath);
	exit;
}

function getIp() {
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$ip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
}

function removeXss($string) { 
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2); 

	for ($i = 0; $i < sizeof($parm); $i++) { 
		$pattern = '/'; 
		for ($j = 0; $j < strlen($parm[$i]); $j++) { 
			if ($j > 0) { 
				$pattern .= '('; 
				$pattern .= '(&#[x|X]0([9][a][b]);?)?'; 
				$pattern .= '|(&#0([9][10][13]);?)?'; 
				$pattern .= ')?'; 
			}
			$pattern .= $parm[$i][$j]; 
		}
		$pattern .= '/i';
		$string = preg_replace($pattern, ' ', $string); 
	}
	return $string;
}

function systemError($msg, $version) {

    header('HTTP/1.1 404 Not Found');
        
    echo <<<EOT
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>错误提示</title>
    <style type="text/css">
        body {
            font: 12px/1.6 Tahoma,microsoft yahei,"微软雅黑","宋体";
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .title {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-size: 26px;
            color: #5B4F5B;
            font-weight: bold;
        }

        .content {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px #ccc dashed;
            font-size: 18px;
            color: #86AF2B;
            font-weight: bold;
        }

        .version {
            font-size: 14px;
            line-height: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="title">
        错误提示
    </div>
    <div class="content">
        $msg
    </div>
    <div class="version">$version</div>
</body>
</html>
EOT;
}

?>