<?php 
global $amp_ux_fields;
$analytics_options = array();
$pages = get_pages();
foreach ($pages as $page ) {
	$options[$page->ID] = $page->post_title;
}
$analytics_options = array('ampforwp-ga-switch'=>'Google Analytics','ampforwp-Segment-switch'=>'Segment Analytics','ampforwp-Piwik-switch'=>'Matomo (Piwik) Analytics','ampforwp-Quantcast-switch'=>'Quantcast Measurement','ampforwp-comScore-switch'=>'comScore', 'ampforwp-Effective-switch'=>'Effective Measure','ampforwp-StatCounter-switch'=>'StatCounter','ampforwp-Histats-switch'=>'Histats Analytics','ampforwp-Yandex-switch'=>'Yandex Metrika','ampforwp-Chartbeat-switch'=>'Chartbeat Analytics','ampforwp-Alexa-switch'=>'Alexa Metrics','ampforwp-afs-analytics-switch'=>'AFS Analytics','amp-fb-pixel'=>'Facebook Pixel','amp-clicky-switch'=>'Clicky Analytics');
$analytics_default_option = ampforwp_get_setting('amp-analytics-select-option');
$analytics_default = 'ampforwp-ga-switch';
switch ($analytics_default_option) {
	case '1': 
		$analytics_default = 'ampforwp-ga-switch';
		break;
	case '2': 
		$analytics_default = 'ampforwp-Segment-switch';
		break;
	case '3': 
		$analytics_default = 'ampforwp-Piwik-switch';
		break;
	case '4': 
		$analytics_default = 'ampforwp-Quantcast-switch';
		break;
	case '5': 
		$analytics_default = 'ampforwp-comScore-switch';
		break;
	case '6': 
		$analytics_default = 'ampforwp-Effective-switch';
		break;
	case '7': 
		$analytics_default = 'ampforwp-StatCounter-switch';
		break;
	case '8': 
		$analytics_default = 'ampforwp-Histats-switch';
		break;
	case '9': 
		$analytics_default = 'ampforwp-Yandex-switch';
		break;
	case '10': 
		$analytics_default = 'ampforwp-Chartbeat-switch';
		break;
	case '11': 
		$analytics_default = 'ampforwp-Alexa-switch';
		break;
	case '12': 
		$analytics_default = 'ampforwp-afs-analytics-switch';
		break;
	case '13': 
		$analytics_default = 'amp-fb-pixel';
		break;
	case '14': 
		$analytics_default = 'amp-clicky-switch';
		break;
	default:
		break;
}

$structure_data_options =  array(
					                'BlogPosting'   => 'Blog',
					                'NewsArticle'   => 'News',
					                'Recipe'        => 'Recipe',
					                'Product'       => 'Product',
					                'VideoObject'   => 'Video Object',
					                'Article'       => 'Article',
					                'WebPage'       => 'WebPage'
					            );
$amp_website_type = ampforwp_get_setting('ampforwp-sd-type-posts');
$amp_ux_fields = array(
					array('field_type'=>'main_section_start', 'field_data'=>array('id'=>'amp-ux-main-section','class'=>'amp-ux-main-section')),
					// Website type 
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1 amp-ux-website-type-section')
					),
					array('field_type'=>'select',
						'field_data'=>array('title'=>'What\'s your Website Type','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-select','options'=>$structure_data_options,'default'=>$amp_website_type)
					),
					array('field_type'=>'section_end','field_data'=>array()),

					// AMP Need Section
				    array('field_type'=>'section_start',
				    	'field_data'=>array('id'=>'ampforwp-ux-need-type-section',
						'class'=>'section-2 amp-ux-need-section')
				    ),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Homepage','class'=>'amp-ux-homepage','id'=>'amp-ux-homepage','default'=>ampforwp_get_setting('ampforwp-homepage-on-off-support'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'FrontPage','class'=>'amp-ux-frontpage','id'=>'amp-ux-frontpage','required'=>array('amp-ux-homepage','=','1'),'default'=>ampforwp_get_setting('amp-frontpage-select-option'))
					),
					array('field_type'=>'select',
						'field_data'=>array('title'=>'Select FrontPage','class'=>'amp-ux-frontpage-select child_opt child_opt_arrow','id'=>'amp-ux-frontpage-select', 'options'=>$options, 'required'=>array('amp-ux-frontpage','=','1'),'default'=>ampforwp_get_setting('amp-frontpage-select-option-pages')
						)
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Posts','class'=>'amp-ux-posts','id'=>'amp-ux-posts','default'=>ampforwp_get_setting('amp-on-off-for-all-posts'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Pages','class'=>'amp-ux-pages','id'=>'amp-ux-pages','default'=>ampforwp_get_setting('amp-on-off-for-all-pages'))
					),
					array('field_type'=>'checkbox',
						'field_data'=>array('title'=>'Archives','class'=>'amp-ux-archives','id'=>'amp-ux-archives','default'=>ampforwp_get_setting('ampforwp-archive-support'))
					),
					array('field_type'=>'section_end','field_data'=>array()),

					// Design Section
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-design-section','class'=>'section-1 ampforwp-ux-design-section')
					),
					array('field_type'=>'media',
						'field_data'=>array('title'=>'Logo','class'=>'amp-ux-opt-media-container','id'=>'amp-ux-opt-media', 'default'=>array('id'=>ampforwp_get_setting('opt-media','id'),'url'=>ampforwp_get_setting('opt-media','url'),'width'=>ampforwp_get_setting('opt-media','width'),'height'=>ampforwp_get_setting('opt-media','height')))
					),
					array('field_type'=>'color',
						'field_data'=>array('title'=>'Global Color Scheme','class'=>'amp-ux-color-scheme','id'=>'amp-ux-color-scheme','default'=>ampforwp_get_setting('swift-color-scheme','color'))
					),
					array('field_type'=>'section_end', 'field_data'=>array()),

					//Analytics
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-analytics-section','class'=>'section-1 ampforwp-ux-analytics-section')
					),
					array('field_type'=>'select',
					'field_data'=>array('title'=>'Setup Analytics Tracking','class'=>'ampforwp-ux-analytics-select child_opt child_opt_arrow','id'=>'ampforwp-ux-analytics-select', 'options'=>$analytics_options,'default'=>$analytics_default,'data-href'=>ampforwp_get_setting('amp-analytics-select-option'),'data-href-id'=>'amp-ux-analytics-hidden')
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Tracking ID','id'=>'amp-ux-ga','class'=>'amp-ux-ga google-analytics analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-ga-switch'), 'data-href'=>'ampforwp-ga-switch','data-text'=>'ga-feild','default'=>ampforwp_get_setting('ga-feild'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Facebook Pixel ID','id'=>'amp-ux-fp','class'=>'amp-ux-fp analytics-text','required'=>array('ampforwp-ux-analytics-select','=','amp-fb-pixel'),'data-href'=>'amp-fb-pixel','data-text'=>'amp-fb-pixel-id','default'=>ampforwp_get_setting('amp-fb-pixel-id'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'SEGMENT WRITE KEY','id'=>'amp-ux-sw','class'=>'amp-ux-sw analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Segment-switch'),'data-href'=>'ampforwp-Segment-switch','data-text'=>'sa-feild','default'=>ampforwp_get_setting('sa-feild'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Matomo (Piwik) Analytics Tracking ID','id'=>'amp-ux-mp','class'=>'amp-ux-mp analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Piwik-switch'),'data-href'=>'ampforwp-Piwik-switch','data-text'=>'pa-feild','default'=>ampforwp_get_setting('pa-feild'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Quantcast Measurement Tracking ID','id'=>'amp-ux-qm','class'=>'amp-ux-qm analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Quantcast-switch'),'data-text'=>'amp-quantcast-analytics-code','default'=>ampforwp_get_setting('amp-quantcast-analytics-code'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'C1','id'=>'amp-ux-cs-1','class'=>'amp-ux-cs analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-comScore-switch'),'data-href'=>'ampforwp-comScore-switch','data-text'=>'amp-comscore-analytics-code-c1','default'=>ampforwp_get_setting('amp-comscore-analytics-code-c1'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'C2','id'=>'amp-ux-cs-2','class'=>'amp-ux-cs analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-comScore-switch'),'data-href'=>'ampforwp-comScore-switch','data-text'=>'amp-comscore-analytics-code-c2','default'=>ampforwp_get_setting('amp-comscore-analytics-code-c2'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Effective Measure Tracking ID','id'=>'amp-ux-em','class'=>'amp-ux-em analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Effective-switch'),'data-href'=>'ampforwp-Effective-switch','data-text'=>'eam-feild','default'=>ampforwp_get_setting('eam-feild'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your StatCounter Tracking ID','id'=>'amp-ux-sc','class'=>'amp-ux-sc analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-StatCounter-switch'),'data-href'=>'ampforwp-StatCounter-switch','data-text'=>'sc-feild','default'=>ampforwp_get_setting('sc-feild'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Histats Analytics Tracking ID','id'=>'amp-ux-ha','class'=>'amp-ux-ha analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Histats-switch'),'data-href'=>'ampforwp-Histats-switch','data-text'=>'histats-field','default'=>ampforwp_get_setting('histats-field'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Yandex Metrika Analytics ID','id'=>'amp-ux-ym','class'=>'amp-ux-ym analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Yandex-switch'),'data-href'=>'ampforwp-Yandex-switch','data-text'=>'amp-Yandex-Metrika-analytics-code','default'=>ampforwp_get_setting('amp-Yandex-Metrika-analytics-code'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Your Tracking ID','id'=>'amp-ux-ca','class'=>'amp-ux-ca analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Chartbeat-switch'),'data-href'=>'ampforwp-Chartbeat-switch','data-text'=>'amp-Chartbeat-analytics-code','default'=>ampforwp_get_setting('amp-Chartbeat-analytics-code'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Alexa Metrics Account','id'=>'amp-ux-am-1','class'=>'amp-ux-am analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Alexa-switch'),'data-href'=>'ampforwp-Alexa-switch','data-text'=>'ampforwp-alexa-account','default'=>ampforwp_get_setting('amp-Chartbeat-analytics-code'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Alexa Metrics Domain','id'=>'amp-ux-am-2','class'=>'amp-ux-am analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-Alexa-switch'),'data-href'=>'ampforwp-Alexa-switch','data-text'=>'ampforwp-alexa-domain','default'=>ampforwp_get_setting('ampforwp-alexa-domain'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Website ID','id'=>'amp-ux-afs','class'=>'amp-ux-afs analytics-text','required'=>array('ampforwp-ux-analytics-select','=','ampforwp-afs-analytics-switch'),'data-href'=>'ampforwp-afs-analytics-switch','data-text'=>'ampforwp-afs-siteid','default'=>ampforwp_get_setting('ampforwp-afs-siteid'))
					),
					array('field_type'=>'text', 'field_data'=>array('title'=>'Clicky Site ID','id'=>'amp-ux-cl','class'=>'amp-ux-cl analytics-text','required'=>array('ampforwp-ux-analytics-select','=','amp-clicky-switch'),'data-href'=>'amp-clicky-switch','data-text'=>'clicky-site-id','default'=>ampforwp_get_setting('clicky-site-id'))
					),
					array('field_type'=>'notification', 'field_data'=>array('title'=>'More Analytics Settings','type'=>'warning','desc'=>sprintf( 'Please click <a href="javascript:void(0);" id="ampforwp-goto-analytics">%s</a> settings.',esc_html__('here for advance analytics','accelerated-mobile-pages' )))
					),

					array('field_type'=>'section_end', 'field_data'=>array()),

					// Privacy Settings
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-privacy-section','class'=>'section-1 ampforwp-ux-privacy-section')
					),
					array('field_type'=>'switch','field_data'=>array('title'=>'Cookie Notice Bar','id'=>'amp-ux-notice-switch','class'=>'amp-ux-notice-switch amp-ux-switch-on-off','data-id'=>'amp-ux-notice-switch','desc'=>'Cookie Bar allows you to discreetly inform visitors that your website uses cookies.','default'=>ampforwp_get_setting('amp-enable-notifications'))
					),
					array('field_type'=>'switch','field_data'=>array('title'=>'GDPR','id'=>'amp-ux-gdpr-switch','class'=>'amp-ux-gdpr-switch amp-ux-switch-on-off','data-id'=>'amp-ux-gdpr-switch','desc'=>'Comply with European privacy regulations(GDPR). Recommended for EU Citizens.','default'=>ampforwp_get_setting('amp-gdpr-compliance-switch'))
					),
					array('field_type'=>'section_end', 'field_data'=>array()),

					// // 3rd Party
					// array('field_type'=>'section_start',
					// 	'field_data'=>array('id'=>'ampforwp-ux-thirdparty-section','class'=>'section-1 ampforwp-ux-thirdparty-section')
					// ),
					// array('field_type'=>'section_end', 'field_data'=>array()),
					array('field_type'=>'main_section_end','field_data'=>array()),
				);
