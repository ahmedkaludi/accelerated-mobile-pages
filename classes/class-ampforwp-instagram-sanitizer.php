<?php
/**
 * Converts Instagram embeds to <amp-instagram>
 */
class AMPFORWP_Instagram_Embed_Sanitizer extends AMP_Base_Sanitizer {
private $instagram_medias = array();
private static $script_slug = 'amp-instagram';
 private static $script_src = 'https://cdn.ampproject.org/v0/amp-instagram-0.1.js';
public function sanitize() {
  $body = $this->get_body_node();
    $xpath = new \DOMXPath($this->dom);
    $class_name = 'instagram-media';
    $blockquotes = $xpath->query("//*[contains(@class,'$class_name')]");
    foreach($blockquotes as $instagram_media){
      $this->replace_with_amp_instagram($instagram_media);
    }
    if(count($this->instagram_medias) > 0){
     $this->did_convert_elements = true;
    }
}
function replace_with_amp_instagram ($instagram_media){
  $medias = $instagram_media->getElementsByTagName('a');
  if($medias->length > 0){
   $media = $medias->item(0);
   $href = $media->getAttribute('href');
   $explode = explode('/', rtrim($href, '/'));
   $sourcecode = end($explode);
   $tag = $this->create_instagram_tag($sourcecode);
   $this->instagram_medias[] = $tag; // add it to array
   $instagram_media->parentNode->replaceChild( $tag, $instagram_media);
  }
 }
function create_instagram_tag($sourcecode){
  $attrs = array(
   'data-shortcode' => $sourcecode,
   'width' => 400,
   'height'=> 400,
   'layout' => 'responsive',
   'data-captioned' => '',
  );
  return AMP_DOM_Utils::create_node($this->dom, 'amp-instagram', $attrs);
 }
public function get_scripts() {
  if ( ! $this->did_convert_elements ) {
   return array();
  }
return array( self::$script_slug => self::$script_src );
 }
}