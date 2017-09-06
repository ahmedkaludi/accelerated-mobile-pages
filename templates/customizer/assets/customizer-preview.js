( function( $ ) {
	'use strict';
 			$( document ).ready( function () {
					
					function ampforwp_design_controller(value) {
							switch (value) {
									case 'title:1':
											$('.ampforwp-title').show();
											$('.ampforwp-title').appendTo('.amp-wp-article');
											break;
									case 'bread_crumbs:1':
											$('.ampforwp-bread-crumbs').show();
											$('.ampforwp-bread-crumbs').appendTo('.amp-wp-article');
											break;		
									case 'meta_info:1':
											$('.ampforwp-meta-info').show();
											$('.ampforwp-meta-info').appendTo('.amp-wp-article');
											break;
									case 'featured_image:1':
											$('.amp-wp-article-featured-image').show();
											$('.amp-wp-article-featured-image').appendTo('.amp-wp-article');
											break;
									case 'content:1':
											$('.amp-wp-article-content').show();
											$('.amp-wp-article-content').appendTo('.amp-wp-article');
											break;
									case 'meta_taxonomy:1':
											$('.ampforwp-meta-taxonomy').show();
											$('.ampforwp-meta-taxonomy').appendTo('.amp-wp-article');
											break;
									case 'social_icons:1':
											$('.ampforwp-social-icons').show();
											$('.ampforwp-social-icons').appendTo('.amp-wp-article');
											break;
									case 'comments:1':
											$('.ampforwp-comment-wrapper').show();
											$('.ampforwp-comment-wrapper').appendTo('.amp-wp-article');
											break;
									case 'related_posts:1':
											$('.amp-wp-content.relatedpost').show();
											$('.amp-wp-content.relatedpost').appendTo('.amp-wp-article');
											break;
									case 'title:0':
											$('.ampforwp-title').hide();
											break;
									case 'meta_info:0':
											$('.ampforwp-meta-info').hide();
											break;
									case 'featured_image:0':
											$('.amp-wp-article-featured-image').hide();
											break;
									case 'content:0':
											$('.amp-wp-article-content').hide();
											break;
									case 'meta_taxonomy:0':
											$('.ampforwp-meta-taxonomy').hide();
											break;
									case 'social_icons:0':
											$('.ampforwp-social-icons').hide();
											break;
									case 'comments:0':
											$('.ampforwp-comment-wrapper').hide();
											break;
									case 'related_posts:0':
											$('.amp-wp-content.relatedpost').hide();
											break;
							}
					}
						
					// Default Settings for the customizer
					var ampforwp_dm_settings =	wp.customize.instance( 'ampforwp_design[elements]' ).get() 
					ampforwp_dm_settings = ampforwp_dm_settings.split(',');
						$.each(ampforwp_dm_settings, function (index, value) {
								ampforwp_design_controller(value);
						});					
							
					// Update the live settings
					wp.customize( 'ampforwp_design[elements]', function( value ){
						value.bind( function( to ) {
							var result = to.split(',');
							$.each(result, function (index, value) {
									ampforwp_design_controller(value);
							});
						} );
					} );
				
 		});
} )( jQuery );
