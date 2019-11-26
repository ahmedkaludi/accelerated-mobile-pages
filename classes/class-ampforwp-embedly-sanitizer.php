<?php
use AMPforWP\AMPVendor\AMP_Base_Sanitizer;
use AMPforWP\AMPVendor\AMP_DOM_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Converts embedly-cards to <amp-embedly-card>
 */
class AMPforWP_Embedly_Sanitizer extends AMP_Base_Sanitizer {
private $embedly_cards = array();
private static $script_slug = 'amp-embedly-card';
 private static $script_src = 'https://cdn.ampproject.org/v0/amp-embedly-card-0.1.js';
public function sanitize() {
    $body = $this->get_body_node();
    $xpath = new DOMXPath($this->dom);
    $class_name = 'embedly-card';
    $blockquotes = $xpath->query("//*[contains(@class,'$class_name')]");
    foreach($blockquotes as $embedly_card){
      $this->replace_with_amp_embedly_card($embedly_card);
    }
    if(count($this->embedly_cards) > 0){
     $this->did_convert_elements = true;
    }
}
function replace_with_amp_embedly_card ($embedly_card){
  $medias = $embedly_card->getElementsByTagName('a');
  if($medias->length > 0){
   $media = $medias->item(0);
   $href = $media->getAttribute('href');
   $tag = $this->create_amp_embedly_card($href);
   $this->embedly_cards[] = $tag; // add it to array
   $embedly_card->parentNode->replaceChild( $tag, $embedly_card);
  }
 }
function create_amp_embedly_card($href){
  $attrs = array(
   'data-url' => $href,
   'width' => 100,
   'height'=> 50,
   'layout' => 'responsive'
  );
  $attrs = ampforwp_amp_consent_check( $attrs );
  return AMP_DOM_Utils::create_node($this->dom, 'amp-embedly-card', $attrs);
 }
public function get_scripts() {
  if ( ! $this->did_convert_elements ) {
   return array();
  }
return array( self::$script_slug => self::$script_src );
 }
}