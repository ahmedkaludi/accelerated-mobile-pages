<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
add_action('amp_post_template_head', 'ampforwp_default_og_tags', 50);
if ( ! function_exists('ampforwp_default_og_tags') ) {
	function ampforwp_default_og_tags(){
		global $wp;
		if ( true == ampforwp_get_setting('ampforwp-seo-og-meta-tags') && '' == ampforwp_get_setting('ampforwp-seo-selection') ) {
			$og_tags = array();
			$post_id = $post = $locale = $type = $title = $site_title = $desc = $url = $pub_date = $mod_date = $image = $image_width = $image_height = '';
			$post_id = ampforwp_get_the_ID();
			$post = get_post($post_id);
			// og:locale
			$locale = get_locale();
			// Catch some weird locales served out by WP that are not easily doubled up.
			$fix_locales = array(
				'ca' => 'ca_ES',
				'en' => 'en_US',
				'el' => 'el_GR',
				'et' => 'et_EE',
				'ja' => 'ja_JP',
				'sq' => 'sq_AL',
				'uk' => 'uk_UA',
				'vi' => 'vi_VN',
				'zh' => 'zh_CN',
			);

			if ( isset( $fix_locales[ $locale ] ) ) {
				$locale = $fix_locales[ $locale ];
			}

			// Convert locales like "es" to "es_ES", in case that works for the given locale (sometimes it does).
			if ( strlen( $locale ) === 2 ) {
				$locale = strtolower( $locale ) . '_' . strtoupper( $locale );
			}

			// These are the locales FB supports.
			$valid_fb_locales = array(
				'af_ZA', // Afrikaans.
				'ak_GH', // Akan.
				'am_ET', // Amharic.
				'ar_AR', // Arabic.
				'as_IN', // Assamese.
				'ay_BO', // Aymara.
				'az_AZ', // Azerbaijani.
				'be_BY', // Belarusian.
				'bg_BG', // Bulgarian.
				'bp_IN', // Bhojpuri.
				'bn_IN', // Bengali.
				'br_FR', // Breton.
				'bs_BA', // Bosnian.
				'ca_ES', // Catalan.
				'cb_IQ', // Sorani Kurdish.
				'ck_US', // Cherokee.
				'co_FR', // Corsican.
				'cs_CZ', // Czech.
				'cx_PH', // Cebuano.
				'cy_GB', // Welsh.
				'da_DK', // Danish.
				'de_DE', // German.
				'el_GR', // Greek.
				'en_GB', // English (UK).
				'en_PI', // English (Pirate).
				'en_UD', // English (Upside Down).
				'en_US', // English (US).
				'em_ZM',
				'eo_EO', // Esperanto.
				'es_ES', // Spanish (Spain).
				'es_LA', // Spanish.
				'es_MX', // Spanish (Mexico).
				'et_EE', // Estonian.
				'eu_ES', // Basque.
				'fa_IR', // Persian.
				'fb_LT', // Leet Speak.
				'ff_NG', // Fulah.
				'fi_FI', // Finnish.
				'fo_FO', // Faroese.
				'fr_CA', // French (Canada).
				'fr_FR', // French (France).
				'fy_NL', // Frisian.
				'ga_IE', // Irish.
				'gl_ES', // Galician.
				'gn_PY', // Guarani.
				'gu_IN', // Gujarati.
				'gx_GR', // Classical Greek.
				'ha_NG', // Hausa.
				'he_IL', // Hebrew.
				'hi_IN', // Hindi.
				'hr_HR', // Croatian.
				'hu_HU', // Hungarian.
				'ht_HT', // Haitian Creole.
				'hy_AM', // Armenian.
				'id_ID', // Indonesian.
				'ig_NG', // Igbo.
				'is_IS', // Icelandic.
				'it_IT', // Italian.
				'ik_US',
				'iu_CA',
				'ja_JP', // Japanese.
				'ja_KS', // Japanese (Kansai).
				'jv_ID', // Javanese.
				'ka_GE', // Georgian.
				'kk_KZ', // Kazakh.
				'km_KH', // Khmer.
				'kn_IN', // Kannada.
				'ko_KR', // Korean.
				'ks_IN', // Kashmiri.
				'ku_TR', // Kurdish (Kurmanji).
				'ky_KG', // Kyrgyz.
				'la_VA', // Latin.
				'lg_UG', // Ganda.
				'li_NL', // Limburgish.
				'ln_CD', // Lingala.
				'lo_LA', // Lao.
				'lt_LT', // Lithuanian.
				'lv_LV', // Latvian.
				'mg_MG', // Malagasy.
				'mi_NZ', // Maori.
				'mk_MK', // Macedonian.
				'ml_IN', // Malayalam.
				'mn_MN', // Mongolian.
				'mr_IN', // Marathi.
				'ms_MY', // Malay.
				'mt_MT', // Maltese.
				'my_MM', // Burmese.
				'nb_NO', // Norwegian (bokmal).
				'nd_ZW', // Ndebele.
				'ne_NP', // Nepali.
				'nl_BE', // Dutch (Belgie).
				'nl_NL', // Dutch.
				'nn_NO', // Norwegian (nynorsk).
				'nr_ZA', // Southern Ndebele.
				'ns_ZA', // Northern Sotho.
				'ny_MW', // Chewa.
				'om_ET', // Oromo.
				'or_IN', // Oriya.
				'pa_IN', // Punjabi.
				'pl_PL', // Polish.
				'ps_AF', // Pashto.
				'pt_BR', // Portuguese (Brazil).
				'pt_PT', // Portuguese (Portugal).
				'qc_GT', // Quiché.
				'qu_PE', // Quechua.
				'qr_GR',
				'qz_MM', // Burmese (Zawgyi).
				'rm_CH', // Romansh.
				'ro_RO', // Romanian.
				'ru_RU', // Russian.
				'rw_RW', // Kinyarwanda.
				'sa_IN', // Sanskrit.
				'sc_IT', // Sardinian.
				'se_NO', // Northern Sami.
				'si_LK', // Sinhala.
				'su_ID', // Sundanese.
				'sk_SK', // Slovak.
				'sl_SI', // Slovenian.
				'sn_ZW', // Shona.
				'so_SO', // Somali.
				'sq_AL', // Albanian.
				'sr_RS', // Serbian.
				'ss_SZ', // Swazi.
				'st_ZA', // Southern Sotho.
				'sv_SE', // Swedish.
				'sw_KE', // Swahili.
				'sy_SY', // Syriac.
				'sz_PL', // Silesian.
				'ta_IN', // Tamil.
				'te_IN', // Telugu.
				'tg_TJ', // Tajik.
				'th_TH', // Thai.
				'tk_TM', // Turkmen.
				'tl_PH', // Filipino.
				'tl_ST', // Klingon.
				'tn_BW', // Tswana.
				'tr_TR', // Turkish.
				'ts_ZA', // Tsonga.
				'tt_RU', // Tatar.
				'tz_MA', // Tamazight.
				'uk_UA', // Ukrainian.
				'ur_PK', // Urdu.
				'uz_UZ', // Uzbek.
				've_ZA', // Venda.
				'vi_VN', // Vietnamese.
				'wo_SN', // Wolof.
				'xh_ZA', // Xhosa.
				'yi_DE', // Yiddish.
				'yo_NG', // Yoruba.
				'zh_CN', // Simplified Chinese (China).
				'zh_HK', // Traditional Chinese (Hong Kong).
				'zh_TW', // Traditional Chinese (Taiwan).
				'zu_ZA', // Zulu.
				'zz_TR', // Zazaki.
			);

			// Check to see if the locale is a valid FB one, if not, use en_US as a fallback.
			if ( ! in_array( $locale, $valid_fb_locales, true ) ) {
				$locale = strtolower( substr( $locale, 0, 2 ) ) . '_' . strtoupper( substr( $locale, 0, 2 ) );
				if ( ! in_array( $locale, $valid_fb_locales, true ) ) {
					$locale = 'en_US';
				}
			}
			$og_tags['og:locale'] = $locale;

			// og:type
			if ( is_home() ) {
				$type = 'website';
			}
			elseif ( is_singular() ) {
				$type = 'article';
			}
			else {
				// We use "object" for archives
				$type = 'object';
			}
			$og_tags['og:type'] = $type;

			// og:title
			$sep = apply_filters( 'document_title_separator', '-' );
			if ( ampforwp_is_home() ) {
				$site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );
			}
			if ( is_singular() || ampforwp_is_front_page() || ampforwp_is_blog() ) {
				$title = ! empty( $post->post_title ) ? $post->post_title : $title;
				$site_title = $title . $sep . get_option( 'blogname' );
			}
			if ( is_archive() ) {
	            $site_title = strip_tags( get_the_archive_title('') . $sep . get_bloginfo( 'name' ) );
	        }
			if ( is_search() ) {
				$site_title = $redux_builder_amp['amp-translator-search-text'] . ' ' . get_search_query();
			}

			$og_tags['og:title'] = $site_title;

			// og:description
			if ( ampforwp_is_home() || ampforwp_is_blog() ) {
	            $desc = addslashes( strip_tags( get_bloginfo( 'description' ) ) );
	        }
	        if ( is_archive() ) {
	            $desc = addslashes( strip_tags( get_the_archive_description() ) );
	        }
	        if ( is_single() || is_page() ) {
	            if ( has_excerpt() ) {
	                $desc = get_the_excerpt();
	            } else {
	                $desc = $post->post_content;
	            }
	            $desc = preg_replace('/\[(.*?)\]/',' ', $desc);
	            $desc = addslashes( wp_trim_words( strip_tags( $desc ) , 15 ) );
	        }
	        if ( is_search() ) {
	            $desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . ' ' . get_search_query() );
	        }
	        if ( ampforwp_is_front_page() ) {
	            $desc = addslashes( wp_trim_words(  strip_tags( get_post_field('post_content', $post_id) ) , 15 ) );
	        }

	        $og_tags['og:description'] = $desc;

	        // og:url
	        $url = get_permalink( $post_id );
	        if ( ampforwp_is_home() || ampforwp_is_front_page() || is_archive() )	{
				$current_archive_url = home_url( $wp->request );
				$url 	= trailingslashit($current_archive_url);
				$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
				$url 	= str_replace($remove, '', $url);
			  	$query_arg_array = $wp->query_vars;
			  	if( array_key_exists( "page" , $query_arg_array  ) ) {
				   $page = $wp->query_vars['page'];
				  	if ( $page >= '2') { 
						$url = trailingslashit( $url  . '?page=' . $page);
					}
			  	}
			}
			$og_tags['og:url'] = $url;

			// og:site_name
			$og_tags['og:site_name'] = get_bloginfo( 'name' );

			if ( is_singular() ) {
				// article:published_time
				$pub_date = mysql2date( DATE_W3C, $post->post_date_gmt, false );
				$og_tags['article:published_time'] = $pub_date;
				// article:modified_time
				$mod_date = mysql2date( DATE_W3C, $post->post_modified_gmt, false );
				if ( $mod_date !== $pub_date ) {
					$og_tags['article:modified_time'] = $mod_date;
					$og_tags['og:updated_time'] = $mod_date;
				}
			}

			// og:image
			$image = ampforwp_get_post_thumbnail('url', 'full');
			if ( $image ) {
				$image_width = ampforwp_get_post_thumbnail('width', 'full');
				$image_height = ampforwp_get_post_thumbnail('height', 'full');
				$og_tags['og:image'] = $image;
				$og_tags['og:image:width'] = $image_width;
				$og_tags['og:image:height'] = $image_height;
			}

			foreach ( $og_tags as $property => $content ) {
				if ( $content ) {
					echo '<meta property="', esc_attr( $property ), '" content="', esc_attr( $content ), '" />', "\n";
				}
			}
		}
	}
}