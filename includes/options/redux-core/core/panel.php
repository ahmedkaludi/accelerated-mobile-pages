<?php
namespace ReduxCore\ReduxFramework;
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxCore\\ReduxFramework\\reduxCorePanel' ) ) {
        /**
         * Class reduxCorePanel
         */
        class reduxCorePanel {
            /**
             * @var null
             */
            public $parent = null;
            /**
             * @var null|string
             */
            public $template_path = null;
            /**
             * @var null
             */
            public $original_path = null;

            /**
             * Sets the path from the arg or via filter. Also calls the panel template function.
             *
             * @param $parent
             */
            public function __construct( $parent ) {
                $this->parent             = $parent;
                Redux_Functions::$_parent = $parent;
                $this->template_path      = $this->original_path = ReduxFramework::$_dir . 'templates/panel/';
                if ( ! empty( $this->parent->args['templates_path'] ) ) {
                    $this->template_path = trailingslashit( $this->parent->args['templates_path'] );
                }
                $this->template_path = trailingslashit( apply_filters( "redux/{$this->parent->args['opt_name']}/panel/templates_path", $this->template_path ) );
            }

            public function init() {
                $this->panel_template();
            }


            /**
             * Loads the panel templates where needed and provides the container for Redux
             */
            private function panel_template() {

                if ( $this->parent->args['dev_mode'] ) {
                    $this->template_file_check_notice();
                }

                /**
                 * action 'redux/{opt_name}/panel/before'
                 */
                do_action( "redux/{$this->parent->args['opt_name']}/panel/before" );

                echo '<div class="wrap"><h2></h2></div>'; // Stupid hack for Wordpress alerts and warnings

                echo '<div class="clear"></div>';
                echo '<div class="wrap">';

                // Do we support JS?
                echo '<noscript><div class="no-js">' . __( 'Warning- This options panel will not work properly without javascript!', 'accelerated-mobile-pages' ) . '</div></noscript>';

                // Security is vital!
                echo '<input type="hidden" id="ajaxsecurity" name="security" value="' . wp_create_nonce( 'redux_ajax_nonce' . $this->parent->args['opt_name'] ) . '" />';

                /**
                 * action 'redux-page-before-form-{opt_name}'
                 *
                 * @deprecated
                 */
                do_action( "redux-page-before-form-{$this->parent->args['opt_name']}" ); // Remove

                /**
                 * action 'redux/page/{opt_name}/form/before'
                 *
                 * @param object $this ReduxFramework
                 */
                do_action( "redux/page/{$this->parent->args['opt_name']}/form/before", $this );

                $this->get_template( 'container.tpl.php' );

                /**
                 * action 'redux-page-after-form-{opt_name}'
                 *
                 * @deprecated
                 */
                do_action( "redux-page-after-form-{$this->parent->args['opt_name']}" ); // REMOVE

                /**
                 * action 'redux/page/{opt_name}/form/after'
                 *
                 * @param object $this ReduxFramework
                 */
                do_action( "redux/page/{$this->parent->args['opt_name']}/form/after", $this );
                echo '<div class="clear"></div>';
                echo '</div>';

                if ( $this->parent->args['dev_mode'] == true ) {
                    echo '<br /><div class="redux-timer">' . get_num_queries() . ' queries in ' . timer_stop( 0 ) . ' seconds<br/>Redux is currently set to developer mode.</div>';
                }

                // BFCM offer banner

                echo '	<details id="ampforwp-ocassional-pop-up-container">
                <summary class="ampforwp-ocassional-pop-up-open-close-button">'.esc_html('40% OFF - Limited Time Only', 'accelerated-mobile-pages').'<svg fill="#fff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 288.359 288.359" style="enable-background:new 0 0 288.359 288.359;" xml:space="preserve"><g><path d="M283.38,4.98c-3.311-3.311-7.842-5.109-12.522-4.972L163.754,3.166c-4.334,0.128-8.454,1.906-11.52,4.972L4.979,155.394   c-6.639,6.639-6.639,17.402,0,24.041L108.924,283.38c6.639,6.639,17.402,6.639,24.041,0l147.256-147.256   c3.065-3.065,4.844-7.186,4.972-11.52l3.159-107.103C288.49,12.821,286.691,8.291,283.38,4.98z M247.831,130.706L123.128,255.407   c-1.785,1.785-4.679,1.785-6.464,0l-83.712-83.712c-1.785-1.785-1.785-4.679,0-6.464L157.654,40.529   c1.785-1.785,4.679-1.785,6.464,0l83.713,83.713C249.616,126.027,249.616,128.921,247.831,130.706z M263.56,47.691   c-6.321,6.322-16.57,6.322-22.892,0c-6.322-6.321-6.322-16.57,0-22.892c6.321-6.322,16.569-6.322,22.892,0   C269.882,31.121,269.882,41.37,263.56,47.691z"/><path d="M99.697,181.278c-5.457,2.456-8.051,3.32-10.006,1.364c-1.592-1.591-1.5-4.411,1.501-7.412   c1.458-1.458,2.927-2.52,4.26-3.298c1.896-1.106,2.549-3.528,1.467-5.438l-0.018-0.029c-0.544-0.96-1.455-1.658-2.522-1.939   c-1.067-0.279-2.202-0.116-3.147,0.453c-1.751,1.054-3.64,2.48-5.587,4.428c-7.232,7.23-7.595,15.599-2.365,20.829   c4.457,4.457,10.597,3.956,17.463,0.637c5.004-2.364,7.55-2.729,9.46-0.819c2.002,2.002,1.638,5.004-1.545,8.186   c-1.694,1.694-3.672,3.044-5.582,4.06c-0.994,0.528-1.728,1.44-2.027,2.525c-0.3,1.085-0.139,2.245,0.443,3.208l0.036,0.06   c1.143,1.889,3.575,2.531,5.503,1.457c2.229-1.241,4.732-3.044,6.902-5.215c8.412-8.412,8.002-16.736,2.864-21.875   C112.475,178.141,107.109,177.868,99.697,181.278z"/><path d="M150.245,157.91l-31.508-16.594c-1.559-0.821-3.47-0.531-4.716,0.714l-4.897,4.898c-1.25,1.25-1.537,3.169-0.707,4.73   l16.834,31.654c0.717,1.347,2.029,2.274,3.538,2.5c1.509,0.225,3.035-0.278,4.114-1.357c1.528-1.528,1.851-3.89,0.786-5.771   l-3.884-6.866l8.777-8.777l6.944,3.734c1.952,1.05,4.361,0.696,5.928-0.871c1.129-1.129,1.654-2.726,1.415-4.303   C152.63,160.023,151.657,158.653,150.245,157.91z M125.621,165.632c0,0-7.822-13.37-9.187-15.644l0.091-0.092   c2.274,1.364,15.872,8.959,15.872,8.959L125.621,165.632z"/><path d="M173.694,133.727c-1.092,0-2.139,0.434-2.911,1.205l-9.278,9.278l-21.352-21.352c-0.923-0.923-2.175-1.441-3.479-1.441   s-2.557,0.519-3.479,1.441c-1.922,1.922-1.922,5.037,0,6.958l24.331,24.332c1.57,1.569,4.115,1.569,5.685,0l13.395-13.395   c1.607-1.607,1.607-4.213,0-5.821C175.833,134.16,174.786,133.727,173.694,133.727z"/><path d="M194.638,111.35l-9.755,9.755l-7.276-7.277l8.459-8.458c1.557-1.558,1.557-4.081-0.001-5.639   c-1.557-1.557-4.082-1.557-5.639,0l-8.458,8.458l-6.367-6.366l9.117-9.117c1.57-1.57,1.57-4.115,0-5.686   c-0.754-0.755-1.776-1.179-2.843-1.179c-1.066,0-2.089,0.424-2.843,1.178l-13.234,13.233c-0.753,0.754-1.177,1.776-1.177,2.843   c0,1.066,0.424,2.089,1.178,2.843l24.968,24.968c1.57,1.569,4.115,1.569,5.685,0l13.87-13.87c1.57-1.57,1.57-4.115,0-5.686   C198.752,109.78,196.208,109.78,194.638,111.35z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></summary>
                <span class="ampforwp-promotion-close-btn">  &times;  </span>
                <div class="ampforwp-ocassional-pop-up-contents">
            
                    <img src="'.esc_url(AMPFORWP_IMAGE_DIR.'/offers.png').'" class="ampforwp-promotion-surprise-icon" />
                    <p class="ampforwp-ocassional-pop-up-headline">'.esc_html('40% OFF on', 'accelerated-mobile-pages').'<span>'.esc_html(' AMPforWP PRO', 'accelerated-mobile-pages').'</span></p>
                    <p class="ampforwp-ocassional-pop-up-second-headline">'.esc_html('Upgrade the PRO version during this festive season and get our biggest discount of all time on New Purchases, Renewals &amp; Upgrades', 'accelerated-mobile-pages').'</p>
                    <a class="ampforwp-ocassional-pop-up-offer-btn" href="'.esc_url('https://ampforwp.com/november-deal/').'" target="_blank">'.esc_html('Get This Offer Now', 'accelerated-mobile-pages').'</a>
                    <p class="ampforwp-ocassional-pop-up-last-line">'.esc_html('Black Friday, Cyber Monday, Christmas &amp; New year are the only times we offer discounts this big.', 'accelerated-mobile-pages').'</p>
                </div>
            
            </details>
            <style>details#ampforwp-ocassional-pop-up-container{position:fixed;right:1rem;bottom:1rem;margin-top:2rem;color:#6b7280;display:flex;flex-direction:column;z-index:99999}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents{background-color:#1e1e27;box-shadow:0 5px 10px rgba(0,0,0,.15);padding:25px 25px 10px;border-radius:8px;position:absolute;max-height:calc(100vh - 100px);width:350px;max-width:calc(100vw - 2rem);bottom:calc(100% + 1rem);right:0;overflow:auto;transform-origin:100% 100%;color:#95a3b9;margin-bottom:44px}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents::-webkit-scrollbar{width:15px;background-color:#1e1e27}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents::-webkit-scrollbar-thumb{width:5px;border-radius:99em;background-color:#95a3b9;border:5px solid #1e1e27}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents>*+*{margin-top:.75em}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents p>code{font-size:1rem;font-family:monospace}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents pre{white-space:pre-line;border:1px solid #95a3b9;border-radius:6px;font-family:monospace;padding:.75em;font-size:.875rem;color:#fff}details#ampforwp-ocassional-pop-up-container[open] div.ampforwp-ocassional-pop-up-contents{bottom:0;-webkit-animation:.25s ampforwp_ocassional_pop_up_scale;animation:.25s ampforwp_ocassional_pop_up_scale}details#ampforwp-ocassional-pop-up-container span.ampforwp-promotion-close-btn{font-weight:400;font-size:20px;background:#37474f;font-family:sans-serif;border-radius:30px;color:#fff;position:absolute;right:-10px;z-index:99999;padding:0 8px;top:-311px;cursor:pointer;line-height:28px}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents img.ampforwp-promotion-surprise-icon{width:40px;float:left;margin-right:10px}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents p.ampforwp-ocassional-pop-up-headline{font-size:21px;margin:0;line-height:47px;font-weight:500;color:#fff}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents p.ampforwp-ocassional-pop-up-headline span{color:#f45c43;font-weight:700}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents p.ampforwp-ocassional-pop-up-second-headline{font-size:16px;color:#fff}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents a.ampforwp-ocassional-pop-up-offer-btn{background:#f45c43;background: linear-gradient(to right,#eb3349,#f45c43);padding:13px 38px 14px;color:#fff;text-align:center;border-radius:60px;font-size:18px;display:inline-flex;align-items:center;margin:0 auto 15px;text-decoration:none;line-height:1.2;transform:perspective(1px) translateZ(0);box-shadow:0 0 20px 5px rgb(0 0 0 / 6%);transition:.3s ease-in-out;box-shadow:3px 5px .65em 0 rgb(0 0 0 / 15%);display:inherit}details#ampforwp-ocassional-pop-up-container div.ampforwp-ocassional-pop-up-contents p.ampforwp-ocassional-pop-up-last-line{font-size:12px;color:#a6a6a6}details#ampforwp-ocassional-pop-up-container summary{display:inline-flex;margin-left:auto;margin-right:auto;justify-content:center;align-items:center;font-weight:600;padding:.5em 1.25em;border-radius:99em;color:#fff;background-color:#185adb;box-shadow:0 5px 15px rgba(0,0,0,.1);list-style:none;text-align:center;cursor:pointer;transition:.15s;position:relative;font-size:.9rem;z-index:99999}details#ampforwp-ocassional-pop-up-container summary::-webkit-details-marker{display:none}details#ampforwp-ocassional-pop-up-container summary:hover,summary:focus{background-color:#1348af}details#ampforwp-ocassional-pop-up-container summary svg{width:25px;margin-left:5px;vertical-align:baseline}@-webkit-keyframes ampforwp_ocassional_pop_up_scale{0%{transform:ampforwp_ocassional_pop_up_scale(0)}100%{transform:ampforwp_ocassional_pop_up_scale(1)}}@keyframes ampforwp_ocassional_pop_up_scale{0%{transform:ampforwp_ocassional_pop_up_scale(0)}100%{transform:ampforwp_ocassional_pop_up_scale(1)}}</style>
            <script>function ampforwp_set_admin_occasional_ads_pop_up_cookie(){var o=new Date;o.setFullYear(o.getFullYear()+1),document.cookie="ampforwp_hide_admin_occasional_ads_pop_up_cookie_feedback=1; expires="+o.toUTCString()+"; path=/"}function ampforwp_delete_admin_occasional_ads_pop_up_cookie(){document.cookie="ampforwp_hide_admin_occasional_ads_pop_up_cookie_feedback=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"}function ampforwp_get_admin_occasional_ads_pop_up_cookie(){for(var o="ampforwp_hide_admin_occasional_ads_pop_up_cookie_feedback=",a=decodeURIComponent(document.cookie).split(";"),e=0;e<a.length;e++){for(var c=a[e];" "==c.charAt(0);)c=c.substring(1);if(0==c.indexOf(o))return c.substring(o.length,c.length)}return""}jQuery(function(o){var a=ampforwp_get_admin_occasional_ads_pop_up_cookie();0==a&&""==a&&jQuery("details#ampforwp-ocassional-pop-up-container").attr("open",1);void 0!==a&&""!==a&&o("details#ampforwp-ocassional-pop-up-container").attr("open",!1),o("details#ampforwp-ocassional-pop-up-container span.ampforwp-promotion-close-btn").click(function(a){o("details#ampforwp-ocassional-pop-up-container summary").click()}),o("details#ampforwp-ocassional-pop-up-container summary").click(function(a){var e=o(this).parents("details#ampforwp-ocassional-pop-up-container"),c=o(e).attr("open");void 0!==c&&!1!==c?ampforwp_set_admin_occasional_ads_pop_up_cookie():ampforwp_delete_admin_occasional_ads_pop_up_cookie()})});</script>';

                /**
                 * action 'redux/{opt_name}/panel/after'
                 */
                do_action( "redux/{$this->parent->args['opt_name']}/panel/after" );

            }


            /**
             * Calls the various notification bars and sets the appropriate templates.
             */
            function notification_bar() {

                if ( isset( $this->parent->transients['last_save_mode'] ) ) {

                    if ( $this->parent->transients['last_save_mode'] == "import" ) {
                        /**
                         * action 'redux/options/{opt_name}/import'
                         *
                         * @param object $this ReduxFramework
                         */
                        do_action( "redux/options/{$this->parent->args['opt_name']}/import", $this, $this->parent->transients['changed_values'] );

                        /**
                         * filter 'redux-imported-text-{opt_name}'
                         *
                         * @param string  translated "settings imported" text
                         */
                        echo '<div class="admin-notice notice-blue saved_notice"><strong>' . apply_filters( "redux-imported-text-{$this->parent->args['opt_name']}", __( 'Settings Imported!', 'accelerated-mobile-pages' ) ) . '</strong></div>';
                        //exit();
                    } else if ( $this->parent->transients['last_save_mode'] == "defaults" ) {
                        /**
                         * action 'redux/options/{opt_name}/reset'
                         *
                         * @param object $this ReduxFramework
                         */
                        do_action( "redux/options/{$this->parent->args['opt_name']}/reset", $this );

                        /**
                         * filter 'redux-defaults-text-{opt_name}'
                         *
                         * @param string  translated "settings imported" text
                         */
                        echo '<div class="saved_notice admin-notice notice-yellow"><strong>' . apply_filters( "redux-defaults-text-{$this->parent->args['opt_name']}", __( 'All Defaults Restored!', 'accelerated-mobile-pages' ) ) . '</strong></div>';
                    } else if ( $this->parent->transients['last_save_mode'] == "defaults_section" ) {
                        /**
                         * action 'redux/options/{opt_name}/section/reset'
                         *
                         * @param object $this ReduxFramework
                         */
                        do_action( "redux/options/{$this->parent->args['opt_name']}/section/reset", $this );

                        /**
                         * filter 'redux-defaults-section-text-{opt_name}'
                         *
                         * @param string  translated "settings imported" text
                         */
                        echo '<div class="saved_notice admin-notice notice-yellow"><strong>' . apply_filters( "redux-defaults-section-text-{$this->parent->args['opt_name']}", __( 'Section Defaults Restored!', 'accelerated-mobile-pages' ) ) . '</strong></div>';
                    } else if ( $this->parent->transients['last_save_mode'] == "normal" ) {
                        /**
                         * action 'redux/options/{opt_name}/saved'
                         *
                         * @param mixed $value set/saved option value
                         */
                        do_action( "redux/options/{$this->parent->args['opt_name']}/saved", $this->parent->options, $this->parent->transients['changed_values'] );

                        /**
                         * filter 'redux-saved-text-{opt_name}'
                         *
                         * @param string translated "settings saved" text
                         */
                        echo '<div class="saved_notice admin-notice notice-green">' . apply_filters( "redux-saved-text-{$this->parent->args['opt_name']}", '<strong>'.__( 'Settings Saved!', 'accelerated-mobile-pages' ) ).'</strong>' . '</div>';
                    }

                    unset( $this->parent->transients['last_save_mode'] );
                    //$this->parent->transients['last_save_mode'] = 'remove';
                    $this->parent->set_transients();
                }

                /**
                 * action 'redux/options/{opt_name}/settings/changes'
                 *
                 * @param mixed $value set/saved option value
                 */
                do_action( "redux/options/{$this->parent->args['opt_name']}/settings/change", $this->parent->options, $this->parent->transients['changed_values'] );

                /**
                 * filter 'redux-changed-text-{opt_name}'
                 *
                 * @param string translated "settings have changed" text
                 */
                echo '<div class="redux-save-warn notice-yellow"><strong>' . apply_filters( "redux-changed-text-{$this->parent->args['opt_name']}", __( 'Settings have changed, you should save them!', 'accelerated-mobile-pages' ) ) . '</strong></div>';

                /**
                 * action 'redux/options/{opt_name}/errors'
                 *
                 * @param array $this ->errors error information
                 */
                do_action( "redux/options/{$this->parent->args['opt_name']}/errors", $this->parent->errors );
                echo '<div class="redux-field-errors notice-red"><strong><span></span> ' . __( 'error(s) were found!', 'accelerated-mobile-pages' ) . '</strong></div>';

                /**
                 * action 'redux/options/{opt_name}/warnings'
                 *
                 * @param array $this ->warnings warning information
                 */
                do_action( "redux/options/{$this->parent->args['opt_name']}/warnings", $this->parent->warnings );
                echo '<div class="redux-field-warnings notice-yellow"><strong><span></span> ' . __( 'warning(s) were found!', 'accelerated-mobile-pages' ) . '</strong></div>';

            }

            /**
             * Used to intitialize the settings fields for this panel. Required for saving and redirect.
             */
            function init_settings_fields() {
                // Must run or the page won't redirect properly
                settings_fields( "{$this->parent->args['opt_name']}_group" );
            }


            /**
             * Used to select the proper template. If it doesn't exist in the path, then the original template file is used.
             *
             * @param $file
             */
            function get_template( $file ) {

                if ( empty( $file ) ) {
                    return;
                }

                if ( file_exists( $this->template_path . $file ) ) {
                    $path = $this->template_path . $file;
                } else {
                    $path = $this->original_path . $file;
                }

                do_action( "redux/{$this->parent->args['opt_name']}/panel/template/" . $file . '/before' );
                $path = apply_filters( "redux/{$this->parent->args['opt_name']}/panel/template/" . $file, $path );
                do_action( "redux/{$this->parent->args['opt_name']}/panel/template/" . $file . '/after' );

                require $path;

            }

            /**
             * Scan the template files
             *
             * @param string $template_path
             *
             * @return array
             */
            public function scan_template_files( $template_path ) {
                $files  = scandir( $template_path );
                $result = array();
                if ( $files ) {
                    foreach ( $files as $key => $value ) {
                        if ( ! in_array( $value, array( ".", ".." ) ) ) {
                            if ( is_dir( $template_path . DIRECTORY_SEPARATOR . $value ) ) {
                                $sub_files = self::scan_template_files( $template_path . DIRECTORY_SEPARATOR . $value );
                                foreach ( $sub_files as $sub_file ) {
                                    $result[] = $value . DIRECTORY_SEPARATOR . $sub_file;
                                }
                            } else {
                                $result[] = $value;
                            }
                        }
                    }
                }

                return $result;
            }

            /**
             * Show a notice highlighting bad template files
             */
            public function template_file_check_notice() {

                if ( $this->template_path == $this->original_path ) {
                    return;
                }

                $core_templates = $this->scan_template_files( $this->original_path );
                $outdated       = false;

                foreach ( $core_templates as $file ) {
                    $developer_theme_file = false;

                    if ( file_exists( $this->template_path . $file ) ) {
                        $developer_theme_file = $this->template_path . $file;
                    }

                    if ( $developer_theme_file ) {
                        $core_version      = Redux_Helpers::get_template_version( $this->original_path . $file );
                        $developer_version = Redux_Helpers::get_template_version( $developer_theme_file );

                        if ( $core_version && $developer_version && version_compare( $developer_version, $core_version, '<' ) ) {
                            ?>
                            <div id="message" class="error redux-message">
                                <p><?php _e( '<strong>Your panel has bundled outdated copies of Redux Framework template files</strong> &#8211; if you encounter functionality issues this could be the reason. Ensure you update or remove them.', 'accelerated-mobile-pages' ); ?></p>
                            </div>
                            <?php
                            return;
                        }
                    }

                }
            }

            /**
             * Outputs the HTML for a given section using the WordPress settings API.
             *
             * @param $k - Section number of settings panel to display
             */
            function output_section( $k ) {
                do_settings_sections( $this->parent->args['opt_name'] . $k . '_section_group' );
            }

        }
    }