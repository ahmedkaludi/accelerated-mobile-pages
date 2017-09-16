<?php
add_action('amp_call_button','amp_call_button_html_output');
function amp_call_button_html_output(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
		<div class="amp-phone">
			<a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield']; ?>"></a>
		</div> <?php
  }
}
add_action('amp_post_template_css','amp_callnow_styles',11); 
function amp_callnow_styles(){
    global $redux_builder_amp; if ($redux_builder_amp['ampforwp-callnow-button']) { ?>
.amp-phone{ position:relative }
.amp-phone a:before { content: ""; display:inline-block; width: 4px; height: 8px; border-width: 6px 0 6px 3px; border-style: solid; border-color:<?php echo $redux_builder_amp['amp-opt-color-rgba-colorscheme-call']['color']; ?>; background: transparent; transform: rotate(-30deg); box-sizing: initial; border-top-left-radius: 3px 5px; border-bottom-left-radius: 3px 5px; }
<?php }} ?>