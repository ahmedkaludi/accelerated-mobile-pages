<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// This file only loads once on welcome page
function ampforwp_strposOffset($search, $string, $offset)
{
    /*** explode the string ***/
    $arr = explode($search, $string);
    /*** check the search is not out of bounds ***/
    switch( $offset )
    {
        case $offset == 0:
        return false;
        break;
    
        case $offset > max(array_keys($arr)):
        return false;
        break;

        default:
        return strlen(implode($search, array_slice($arr, 0, $offset)));
    }
}

function ampforwp_nl2p($string, $only_if_no_html = TRUE) {
  // Replace the input string by default unless we find a reason not to.
  $replace = TRUE;
  // If the only_if_no_html flag is set, then we only want to replace if no HTML is detected
  if ($only_if_no_html) {
    // Create a string of the input string with stripped tags
    $str2 = strip_tags($string);
    // If there is a difference, then HTML must have been in the input string.
    // Since HTML already exists, we do not want to replace new lines with HTML
    if ($str2 != $string) {
      $replace = FALSE;
    }
  }
  // Now return the replacement string if we are supposed to replace it.
  if ($replace) {
    return
      preg_replace('#\*(.*?)\n#', '<li>$1</li>', $string);
  }
  // Otherwise, we just return the input string.
  return $string;
}

$readme_file = AMPFORWP_PLUGIN_DIR.'changelog.txt';
$readme = file_get_contents($readme_file);

$readme = preg_replace('/`(.*?)`/', '<code>\\1</code>', $readme);

$readme = preg_replace('/[\040]\*\*(.*?)\*\*/', ' <strong>\\1</strong>', $readme);
$readme = preg_replace('/[\040]\*(.*?)\*/', ' <em>\\1</em>', $readme);

$readme = preg_replace('/=== (.*?) ===/', '<h2>\\1</h2>', $readme);
$readme = preg_replace('/== (.*?) ==/', '<h3>\\1</h3>', $readme);
$readme = preg_replace('/= (.*?) =/', '</ul><h4>\\1</h4><ul>', $readme);


$pos =  strpos($readme,'<h3>Changelog</h3>');
$changelogtxt = substr($readme,$pos);

$ending =  ampforwp_strposOffset('<h4>', $changelogtxt, 4);
$readme = substr($changelogtxt,0,$ending);

preg_match_all('#\[([^\[]+)\]\(([^\)]+)\)#', $readme, $matches);

if(is_array($matches) && count($matches)>2){
    $foundText = $matches[0];
    $foundTitle = $matches[1];
    $foundLink = $matches[2];
    foreach ($foundTitle as $key => $value) {
        $replaceHtml = '<a href="'.$foundLink[$key].'">'.$value.'</a>';
        $readme = str_replace($foundText[$key], $replaceHtml, $readme);
    }
}

echo ampforwp_wp_kses(ampforwp_nl2p($readme,false));

?>
