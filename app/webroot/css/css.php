<?php

    $css = file_get_contents($_GET['url']);
    $css = str_replace('behavior:url(','behavior:url('.dirname($_SERVER['REQUEST_URI']).'/../',$css);
    
    $templateModified = time();
    header("Date: " . date("D, j M Y G:i:s ", $templateModified) . 'GMT');
	header("Content-Type: text/css");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 1) . " GMT");
	header("Cache-Control: max-age=86400, must-revalidate"); // HTTP/1.1
	header("Pragma: cache");        // HTTP/1.0
	
	echo $css;
?>