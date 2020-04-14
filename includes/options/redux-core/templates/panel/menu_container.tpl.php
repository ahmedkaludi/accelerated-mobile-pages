<?php
namespace ReduxCore\ReduxFramework;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * The template for the menu container of the panel.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author 	Redux Framework
 * @package 	ReduxFramework/Templates
 * @version:    3.5.4
 */

?>
<div class="redux-sidebar">
    <ul class="redux-group-menu">
<?php
        $i=0;
        foreach ( $this->parent->sections as $k => $section ) {
            $i++;
            if($i==2){
                $amp_opt = get_option("ampforwp_option_panel_view_type");
                $opt_visible = "";
                if(($amp_opt==1 || $amp_opt=="") && !get_theme_support('amp-template-mode')){
                    $opt_visible = 'style=display:none';
                }
            }
            $title = isset ( $section[ 'title' ] ) ? $section[ 'title' ] : '';

            $skip_sec = false;
            foreach ( $this->parent->hidden_perm_sections as $num => $section_title ) {
                if ( $section_title == $title ) {
                    $skip_sec = true;
                }
            }

            if ( isset ( $section[ 'customizer_only' ] ) && $section[ 'customizer_only' ] == true ) {
                continue;
            }

            if ( false == $skip_sec ) {
                echo $this->parent->section_menu ( $k, $section );
                $skip_sec = false;
            }
        }

        /**
         * action 'redux-page-after-sections-menu-{opt_name}'
         *
         * @param object $this ReduxFramework
         */
        do_action ( "redux-page-after-sections-menu-{$this->parent->args[ 'opt_name' ]}", $this );

        /**
         * action 'redux/page/{opt_name}/menu/after'
         *
         * @param object $this ReduxFramework
         */
        do_action ( "redux/page/{$this->parent->args[ 'opt_name' ]}/menu/after", $this );
        $opt_easy = "";
        $opt_easy_active = "";
        $opt_full = "";
        $opt_full_active = "";
        $opt_easy_checked = "";
        $opt_full_checked = "";
        if($amp_opt==1 || $amp_opt==""){
            $opt_easy = 'visible';
            $opt_easy_checked = 'checked=checked';
            $opt_easy_active = "active";
        }else if($amp_opt==2){
            $opt_full = 'visible';
            $opt_full_checked = 'checked=checked';
            $opt_full_active = 'active';
        }
    if(!get_theme_support('amp-template-mode')){
?>
     <li>
          <div class="switch-ef-btns">
            <div class="e-v <?php echo $opt_easy_active;?>">
                <input class="amp-opt-change <?php echo esc_attr($opt_easy);?>" id="radio-c" type="radio" name="second-switch" <?php echo esc_attr($opt_easy_checked);?>>
                <label for="radio-c" id="basic">Basic Setup</label>
            </div>
            <div class="f-v <?php echo $opt_full_active;?>">
                <input class="amp-opt-change <?php echo esc_attr($opt_full);?>" id="radio-d" type="radio" name="second-switch" <?php echo esc_attr($opt_full_checked);?>>
                <label for="radio-d" id="advanced">Advance Setup</label><span class="toggle-outside">
                    <span class="toggle-inside"></span>
            </div>
    </div>
    </li>
    <?php }?>
    </ul>
</div>