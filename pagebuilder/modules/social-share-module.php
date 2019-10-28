<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
add_filter("ampforwp_extension_pagebuilder_module_template", 'socialmod', 10, 3);
function socialmod($moduleFrontHtml, $htmlTemplate, $contentArray){
	$amp_permalink ='';
	$current_title = '';
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
	$image = '';
	if (ampforwp_has_post_thumbnail( ) ){
		$image = ampforwp_get_post_thumbnail( 'url', 'full' );
	}
	$current_title = get_the_title();
	$moduleFrontHtml = str_replace('{{current_permalink}}', $amp_permalink, $moduleFrontHtml);
	$moduleFrontHtml = str_replace('{{current_title}}', $current_title, $moduleFrontHtml);
	$moduleFrontHtml = str_replace('{{image}}', $image, $moduleFrontHtml);
	
	return $moduleFrontHtml;
}

$output = '
	 <div {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}">
	 	<div class="social-icons">
	 		<ul>
	 			{{if_condition_fb-enable==1}}
	 			<li>
					<a class="sm_fb" target="_blank" rel=nofollow href="https://www.facebook.com/sharer.php?u={{current_permalink}}" aria-label="facebook share"></a>
				</li>
				{{ifend_condition_fb-enable_1}}
				{{if_condition_tw-enable==1}}
	 			<li>
					<a class="sm_tw" target="_blank" rel=nofollow href="https://twitter.com/intent/tweet?url={{current_permalink}}&text={{current_title}}"  aria-label="twitter share"></a>
				</li>
				{{ifend_condition_tw-enable_1}}
				{{if_condition_em-enable==1}}
	 			<li>
					<a class="sm_em" target="_blank" rel=nofollow href="mailto:?subject={{current_title}}&body={{current_permalink}}" aria-label="email share"></a>
				</li>
				{{ifend_condition_em-enable_1}}
				{{if_condition_pin-enable==1}}
	 			<li>
					<a class="sm_pt" target="_blank" rel=nofollow href="https://pinterest.com/pin/create/button/?media={{image}}&url={{current_permalink}}&description={{current_title}}" aria-label="pinterest share"></a>
				</li>
				{{ifend_condition_pin-enable_1}}
				{{if_condition_lnk-enable==1}}
	 			<li>
					<a class="sm_lk" target="_blank" rel=nofollow href="https://www.linkedin.com/shareArticle?url={{current_permalink}}&title={{current_title}}" aria-label="linkedin share"></a>
				</li>
				{{ifend_condition_lnk-enable_1}}
				{{if_condition_wap-enable==1}}
	 			<li>
					<a class="sm_wp" target="_blank" rel=nofollow  href="https://api.whatsapp.com/send?text={{current_permalink}}" data-action="share/whatsapp/share" aria-label="whatsapp share"></a>
				</li>
				{{ifend_condition_wap-enable_1}}
				{{if_condition_line-enable==1}}
	 			<li>
					<a title="line share" class="sm_li" rel=nofollow href="{{current_permalink}}" aria-label="line share"></a>
				</li>
				{{ifend_condition_line-enable_1}}
				{{if_condition_vk-enable==1}}
	 			<li>
					<a class="sm_vk" target="_blank" rel=nofollow href="http://vk.com/share.php?url={{current_permalink}}" aria-label="vk share"></a>
				</li>
				{{ifend_condition_vk-enable_1}}
				{{if_condition_od-enable==1}}
	 			<li>
					<a class="sm_od" target="_blank" rel=nofollow  href="https://ok.ru/dk?st.cmd=addShare&st._surl={{current_permalink}}" aria-label="odnoklassniki share"></a>
				</li>
				{{ifend_condition_od-enable_1}}
				{{if_condition_rd-enable==1}}
	 			<li>
					<a class="sm_rd" target="_blank" rel=nofollow href="https://reddit.com/submit?url={{current_permalink}}&title={{current_title}}" aria-label="reddit share"></a>
				</li>
				{{ifend_condition_rd-enable_1}}
				{{if_condition_tmb-enable==1}}
	 			<li>
					<a class="sm_tb" target="_blank" rel=nofollow href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={{current_permalink}}" aria-label="tumbler share"></a>
				</li>
				{{ifend_condition_tmb-enable_1}}
				{{if_condition_tg-enable==1}}
	 			<li>
					<a class="sm_tg" target="_blank" rel=nofollow href="https://telegram.me/share/url?url={{current_permalink}}&text={{current_title}}" aria-label="telegram share"></a>
				</li>
				{{ifend_condition_tg-enable_1}}
				{{if_condition_stu-enable==1}}
	 			<li>
					<a class="sm_su" target="_blank" rel=nofollow href="http://www.stumbleupon.com/submit?url={{current_permalink}}&title={{current_title}}" aria-label="stumbleupon share"></a>
				</li>
				{{ifend_condition_stu-enable_1}}
				{{if_condition_wc-enable==1}}
	 			<li>
					<a class="sm_wc" target="_blank" rel=nofollow href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url={{current_permalink}}" aria-label="wechat share"></a>
				</li>
				{{ifend_condition_wc-enable_1}}
				{{if_condition_vb-enable==1}}
	 			<li>
					<a class="sm_vb" target="_blank" rel=nofollow href="viber://forward?text={{current_permalink}}" aria-label="viber share"></a>
				</li>
				{{ifend_condition_vb-enable_1}}
				{{if_condition_htb-enable==1}}
	 			<li>
					<a class="sm_hb" target="_blank" rel=nofollow href="http://b.hatena.ne.jp/entry/{{current_permalink}}&title={{current_title}}" aria-label="hatena share"></a>
				</li>
				{{ifend_condition_htb-enable_1}}
				{{if_condition_pkt-enable==1}}
	 			<li>
					<a class="sm_pk" target="_blank" rel=nofollow href="https://getpocket.com/save?url={{current_permalink}}&title={{current_title}}" aria-label="pocket share"></a>
				</li>
				{{ifend_condition_pkt-enable_1}}
				{{if_condition_yml-enable==1}}
	 			<li>
					<a class="sm_ym" target="_blank" rel=nofollow href="http://www.yummly.com/urb/verify?url=<{{current_permalink}}&title={{current_title}}&yumtype=button" aria-label="yummly share"></a>
				</li>
				{{ifend_condition_yml-enable_1}}
				{{if_condition_mw-enable==1}}
	 			<li>
					<a title="mewe share" class="sm_mewe" target="_blank" rel=nofollow href="https://mewe.com/share?link={{current_permalink}}" aria-label="mewe share"></a>
				</li>
				{{ifend_condition_mw-enable_1}}
				{{if_condition_flb-enable==1}}
	 			<li>
					<a title="flipboard share" class="sm_flipboard" rel=nofollow href="https://share.flipboard.com/bookmarklet/popout?v={{current_title}}&url={{current_permalink}}" target="_blank" aria-label="flipboard share"></a>
				</li>
				{{ifend_condition_flb-enable_1}}
	 		</ul>
	 	</div>
	 </div>
';
$swift_icon = '';
$font_awesome = "";
$ampforwp_font_icon = ampforwp_get_setting('ampforwp_font_icon');
if ( empty($ampforwp_font_icon) ) {
	$ampforwp_font_icon = 'swift-icons';
}
if ( $ampforwp_font_icon == 'swift-icons' ){ 
	$swift_icon = '
	.social-icons li{font-family: "icomoon";list-style-type:none;display: inline-block;}
	{{if_condition_fb-enable==1}}
		.sm_fb:after {content: "\e92d";}
	{{ifend_condition_fb-enable_1}}
	{{if_condition_tw-enable==1}}
		.sm_tw:after{content: "\e942";}
	{{ifend_condition_tw-enable_1}}
	{{if_condition_em-enable==1}}
		.sm_em:after{content: "\e930";}
	{{ifend_condition_em-enable_1}}
	{{if_condition_pin-enable==1}}
		.sm_pt:after{content: "\e937";}
	{{ifend_condition_pin-enable_1}}
	{{if_condition_lnk-enable==1}}
		.sm_lk:after{content: "\e934";}
	{{ifend_condition_lnk-enable_1}}
	{{if_condition_wap-enable==1}}
		.sm_wp:after{content: "\e946";}
	{{ifend_condition_wap-enable_1}}
	{{if_condition_line-enable==1}}
		.sm_li:after{content: "\LN";}
	{{ifend_condition_line-enable_1}}
	{{if_condition_vk-enable==1}}
		.sm_vk:after{content: "\e944";}
	{{ifend_condition_vk-enable_1}}
	{{if_condition_od-enable==1}}
		.sm_od:after{content: "\e936";}
	{{ifend_condition_od-enable_1}}
	{{if_condition_rd-enable==1}}
		.sm_rd:after{content: "\e938";}
	{{ifend_condition_rd-enable_1}}
	{{if_condition_tmb-enable==1}}
		.sm_tb:after{content: "\e940";}
	{{ifend_condition_tmb-enable_1}}
	{{if_condition_tg-enable==1}}
		.sm_tg:after{content: "\e93f";}
	{{ifend_condition_tg-enable_1}}
	{{if_condition_stu-enable==1}}
		.sm_su:after{content: "\e93e";}
	{{ifend_condition_stu-enable_1}}
	{{if_condition_wc-enable==1}}
		.sm_wc:after{content: "\e945";}
	{{ifend_condition_wc-enable_1}}
	{{if_condition_vb-enable==1}}
		.sm_vb:after{content: "\e943";}
	{{ifend_condition_vb-enable_1}}
	{{if_condition_htb-enable==1}}
		.sm_hb:after{content: "\e948";}
	{{ifend_condition_htb-enable_1}}
	{{if_condition_pkt-enable==1}}
		.sm_pk:after{content: "\e949";}
	{{ifend_condition_pkt-enable_1}}
	{{if_condition_yml-enable==1}}
		.sm_ym:after{content: "\e948";}
	{{ifend_condition_yml-enable_1}}
	{{if_condition_mw-enable==1}}
		.sm_mewe:after{content: "MW";}
	{{ifend_condition_mw-enable_1}}
	{{if_condition_flb-enable==1}}
		.sm_mewe:after{content: "FB";}
	{{ifend_condition_flb-enable_1}}

	';
}
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ 
	$font_awesome = '
	.social-icons li{font-family: "Font Awesome 5 Brands";list-style-type: none;display: inline-block;}
	{{if_condition_fb-enable==1}}
		.sm_fb:after {content: "\f082";}
	{{ifend_condition_fb-enable_1}}

	';
}	

$css = $swift_icon . $font_awesome.'


';
return array(
		'label' =>'Social Share',
		'name' =>'social-share',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"fb-enable",
			                'label'   => 'Facebook',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tw-enable",
			                'label'   => 'Twitter',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"em-enable",
			                'label'   => 'Email',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"pin-enable",
			                'label'   => 'Pinterest',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"lnk-enable",
			                'label'   => 'LinkedIn',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"wap-enable",
			                'label'   => 'WhatsApp',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"line-enable",
			                'label'   => 'Line',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"vk-enable",
			                'label'   => 'VKontakte',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"od-enable",
			                'label'   => 'Odnoklassniki',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"rd-enable",
			                'label'   => 'Reddit',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tmb-enable",
			                'label'   => 'Tumblr',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tg-enable",
			                'label'   => 'Telegram',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"stu-enable",
			                'label'   => 'StumbleUpon',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"wc-enable",
			                'label'   => 'Wechat',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"vb-enable",
			                'label'   => 'Viber',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"htb-enable",
			                'label'   => 'Hatena Bookmarks',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"pkt-enable",
			                'label'   => 'Pocket',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"yml-enable",
			                'label'   => 'Yummly',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"mw-enable",
			                'label'   => 'MeWe',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"flb-enable",
			                'label'   => 'Flipboard',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
	 					array(
								'type'		=>'text',
								'name'		=>"max-width",
								'label'		=>'Max Width',
								'tab'		=>'design',
								'default'	=>'100%',
								'content_type'=>'css'
							),
						array(
								'type'		=>'text',
								'name'		=>"id",
								'label'		=>'ID',
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),
						array(
								'type'		=>'text',
								'name'		=>"user_class",
								'label'		=>'Class',
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),	
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'0px',
													'bottom'=>'0px'
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);
