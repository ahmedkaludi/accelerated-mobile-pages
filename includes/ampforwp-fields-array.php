<?php 
global $amp_ux_fields;
$pages = get_pages();
foreach ($pages as $page ) {
	$options[$page->ID] = $page->post_title;
}
$amp_ux_fields = array(
					// Website type 
					array('field_type'=>'section_start',
						'field_data'=>array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1 amp-ux-website-type-section')
					),
					array('field_type'=>'select',
						'field_data'=>array('title'=>'What\'s your Website Type','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-select','options'=>array('BlogPosting'=>'Blog','NewsArticle'=>'News'),'default'=>(ampforwp_get_setting('ampforwp-sd-type-posts')))
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
					array('field_type'=>'section_end', 'field_data'=>array())

					//Analytics
					// array('field_type'=>'section_start',
					// 	'field_data'=>array('id'=>'ampforwp-ux-analytics-section','class'=>'section-1 ampforwp-ux-analytics-section')
					// 	/*array('field_type'=>'select',
					// 	'field_data'=>array('title'=>'Setup Analytics Tracking','class'=>'ampforwp-ux-analytics-select child_opt child_opt_arrow','id'=>'ampforwp-ux-analytics-select', 'options'=>$options)
					// 	)*/
					// ),
					// array('field_type'=>'section_end', 'field_data'=>array()),

					// // Privacy Settings
					// array('field_type'=>'section_start',
					// 	'field_data'=>array('id'=>'ampforwp-ux-privacy-section','class'=>'section-1 ampforwp-ux-privacy-section')
					// ),
					// array('field_type'=>'section_end', 'field_data'=>array()),

					// // 3rd Party
					// array('field_type'=>'section_start',
					// 	'field_data'=>array('id'=>'ampforwp-ux-thirdparty-section','class'=>'section-1 ampforwp-ux-thirdparty-section')
					// ),
					// array('field_type'=>'section_end', 'field_data'=>array()),
				);
