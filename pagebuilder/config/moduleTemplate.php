<?php
$moduleTemplate = array();
$dir = AMP_PAGE_BUILDER.'/modules/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {

        while (($file = readdir($dh)) !== false) {
        	if(is_file($dir.$file)){
        		$moduleTemplate[str_replace(".php", "", $file)] = include $dir.$file;
        	}
        }
        closedir($dh);
        $moduleTemplate = array_filter($moduleTemplate);
    }
}
