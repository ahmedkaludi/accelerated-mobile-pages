<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
add_filter("ampforwp_extension_pagebuilder_module_template", 'socialmod', 10, 3);
function socialmod($moduleFrontHtml, $htmlTemplate, $contentArray){
	$amp_permalink ='';
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
	$moduleFrontHtml = str_replace('{{current_permalink}}', $amp_permalink, $moduleFrontHtml);
	return $moduleFrontHtml;
}

$output = '
	 <div {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}">
	 	<div class="social-icons">
	 		<ul>
	 			{{if_condition_fb-enable==1}}
	 			<li>
					<a class="s_fb" target="_blank" rel=nofollow href="https://www.facebook.com/sharer.php?u={{current_permalink}}" aria-label="facebook share">Facebook</a>
				</li>
				{{ifend_condition_fb-enable_1}}
	 		</ul>
	 	</div>
	 </div>
';
$css = '

';
return array(
		'label' =>'Social Share Module',
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
