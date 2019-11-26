<?php
namespace ReduxCore\ReduxFramework;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    /**
     * The template for the main content of the panel.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author      Redux Framework
     * @package     ReduxFramework/Templates
     * @version:    3.5.4.18
     */
?>
<!-- Header Block -->
<?php $this->get_template( 'header.tpl.php' ); ?>

<!-- Intro Text -->
<?php if ( isset( $this->parent->args['intro_text'] ) ) { ?>
    <div id="redux-intro-text"><?php echo wp_kses_post( $this->parent->args['intro_text'] ); ?></div>
<?php } ?>

<?php $this->get_template( 'menu_container.tpl.php' ); ?>

<div class="redux-main">
    <!-- Stickybar -->
    <?php $this->get_template( 'header_stickybar.tpl.php' ); ?>
    <div id="redux_ajax_overlay">&nbsp;</div>
    <?php
        foreach ($this->parent->sections as $k => $section) {
        if ( isset( $section['customizer_only'] ) && $section['customizer_only'] == true ) {
            continue;
        }

        //$active = ( ( is_numeric($this->parent->current_tab) && $this->parent->current_tab == $k ) || ( !is_numeric($this->parent->current_tab) && $this->parent->current_tab === $k )  ) ? ' style="display: block;"' : '';
         $hide_wrapper = '';
        if(function_exists('amp_activate') ){
            $enabledOptions = array('basic','amp-e-commerce','disqus-comments','opt-text-subsection', 'amp-seo', 'fb-instant-article', 'hide-amp-section','amp-advance', 'amp-translator', 'design', 'amp-theme-settings', 'amp-theme-global-subsection', 'amp-theme-header-settings','amp-theme-homepage-settings', 'amp-single', 'amp-theme-footer-settings', 'amp-theme-page-settings', 'amp-social', 'ampforwp-date-section', 'amp-design','ampforwp-new-ux');
            $enabledOptions = apply_filters( 'ampforwp_standalone_mode_wrapper', $enabledOptions );
            if(in_array($section['id'], $enabledOptions)){
                 $hide_wrapper = '<div class="ampforwp_addon_mode"><div class="hide-wrapper"></div><div class="amp-watermark-wrapper"><a class="amp-watermark" href="https://ampforwp.com/tutorials/article/guide-to-amp-by-automattic-compatibility-in-ampforwp/" target="_blank">
                      <h3>Available in Standalone Mode</h3>
                        <p>You are using AMPforWP as an Addon Mode.</p>
                        <span>Learn More</span>
                    </a></div></div>';
            }
        }
        $section['class'] = isset( $section['class'] ) ? ' ' . $section['class'] : '';
        echo '<div id="' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr( $section['class'] ). ' '.$section['id'] . '" data-rel="' . $k . '">'.$hide_wrapper;
        //echo '<div id="' . $k . '_nav-bar' . '"';
        /*
    if ( !empty( $section['tab'] ) ) {

        echo '<div id="' . $k . '_section_tabs' . '" class="redux-section-tabs">';

        echo '<ul>';

        foreach ($section['tab'] as $subkey => $subsection) {
            //echo '-=' . $subkey . '=-';
            echo '<li style="display:inline;"><a href="#' . $k . '_section-tab-' . $subkey . '">' . $subsection['title'] . '</a></li>';
        }

        echo '</ul>';
        foreach ($section['tab'] as $subkey => $subsection) {
            echo '<div id="' . $k .'sub-'.$subkey. '_section_group' . '" class="redux-group-tab" style="display:block;">';
            echo '<div id="' . $k . '_section-tab-' . $subkey . '">';
            echo "hello ".$subkey;
            do_settings_sections( $this->parent->args['opt_name'] . $k . '_tab_' . $subkey . '_section_group' );
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        */

        // Don't display in the
        $display = true;
        if ( isset( $_GET['page'] ) && $_GET['page'] == $this->parent->args['page_slug'] ) {
            if ( isset( $section['panel'] ) && $section['panel'] == "false" ) {
                $display = false;
            }
        }

        if ( $display ) {
            do_action( "redux/page/{$this->parent->args['opt_name']}/section/before", $section );
            $this->output_section( $k );
            do_action( "redux/page/{$this->parent->args['opt_name']}/section/after", $section );
        }
        //}
        include_once AMPFORWP_PLUGIN_DIR.'classes/ampforwp-fields.php';
    ?></div><?php
    //print '</div>';
    }

    /**
     * action 'redux/page-after-sections-{opt_name}'
     *
     * @deprecated
     *
     * @param object $this ReduxFramework
     */
    do_action( "redux/page-after-sections-{$this->parent->args['opt_name']}", $this ); // REMOVE LATER

    /**
     * action 'redux/page/{opt_name}/sections/after'
     *
     * @param object $this ReduxFramework
     */
    do_action( "redux/page/{$this->parent->args['opt_name']}/sections/after", $this );
?>
<div class="clear"></div>
<!-- Footer Block -->
<?php $this->get_template( 'footer.tpl.php' ); ?>
<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
</div>
<div class="clear"></div>