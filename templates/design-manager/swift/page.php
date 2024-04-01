<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
amp_header(); ?>
<div <?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>class="sp"<?php } ?>>
	<div <?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>class="cntr"<?php } ?>>
		<?php if( !ampforwp_levelup_compatibility('levelup_elementor') ){ // Level up Condition starts ?>
		<?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>
			<?php if ( is_page() && true == ampforwp_get_setting('ampforwp_pages_breadcrumbs') ) {
				amp_breadcrumb();
			}?>
		 	<?php if ( (is_page() && true == ampforwp_get_setting('ampforwp_pages_title')) ||  (ampforwp_is_front_page() && ampforwp_get_setting('ampforwp-title-on-front-page'))) {
				amp_title();
			}?>
		<?php } ?>
		<?php } // Level up Condition ends here?>
		</div>
		<?php 
		$paged = get_query_var( 'paged' );
	 	$page = get_query_var( 'page' );
	    if($paged==0 && $page==0){
	   		if ( true == ampforwp_get_setting('featured_image_swift_page') && ampforwp_has_post_thumbnail() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) { ?> 
				<div class="sf-img">
					<?php amp_featured_image();?>
				</div>
				<?php }elseif (true == ampforwp_get_setting('featured_image_swift_page') && true == ampforwp_get_setting('featured_image_swift_page_builder')) {?>
				<div class="sf-img">
					<?php amp_featured_image();?>
				</div>
			<?php } } ?>
		<div <?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>class="cntr"<?php } ?>>	
       <div class="pg">
       		<?php if (  is_page() && true == ampforwp_get_setting('ampforwp-page-social') && 'above-content' ==  ampforwp_get_setting('swift-social-position') ){
							ampforwp_swift_social_icons(); 
			
			
			} ?>
			<div class="cntn-wrp">
				<?php if (  is_page() && true == ampforwp_get_setting('ampforwp-page-social') && 'above-content' ==  ampforwp_get_setting('swift-add-this-position') ){
					echo ampforwp_addThis_support(); 
				}
				if(ampforwp_is_front_page() && false == ampforwp_get_setting('gbl-sidebar') ){
					amp_content();
					if(ampforwp_get_comments_status()){ ?>
						<div class="cmts">
							<?php amp_comments();?>
						</div>
					<?php }
				}
				if(!ampforwp_is_front_page()){
					amp_content();
				}
				if( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && is_page() && true == ampforwp_get_setting('ampforwp-page-social') && 'above-content' !=  ampforwp_get_setting('swift-social-position') ) { 
						echo ampforwp_swift_social_icons();
		        	} ?>
		    	<?php if( !ampforwp_levelup_compatibility('levelup_elementor') && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && !ampforwp_is_front_page()){ // Level up Condition starts ?>
					<div class="cmts">
						<?php amp_comments();?>
					</div>
				<?php } // Level up Condition ends
				if( true == ampforwp_get_setting('ampforwp-pages-recent-posts') && !checkAMPforPageBuilderStatus(get_the_ID()) ) {?>
                    <div class="pg rc-pt">
                        <h3><?php echo ampforwp_translation($redux_builder_amp['amp-translator-recent-text'], 'Recent Posts' ); ?></h3>
                        <?php
                        $number_of_posts = 6;
                        $rcp = ampforwp_get_setting('ampforwp-pages-number-of-recent-posts');
                        if( !empty($rcp) ){
                            $number_of_posts = (int) ampforwp_get_setting('ampforwp-pages-number-of-recent-posts');
                        }
                        while( amp_loop('start', array( 'posts_per_page' => $number_of_posts ) ) ): ?>
                            <div class="pg-fsp">
                                <?php
                                if(ampforwp_has_post_thumbnail()){
                                    $width  = 346;
                                    $height = 188;
                                    $args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
                                    <?php 
                                if( ampforwp_get_setting('ampforwp-pages-recentpost-image') == true){
                                ?>
                                    <div class="pg-fsp-img">
                                        <?php amp_loop_image($args); ?>
                                    </div>
                                <?php } ?>
                                <?php } ?>
                                <div class="pg-fsp-cnt">
                                    <?php amp_loop_category(); ?>
                                    <?php amp_loop_title(); ?>
                                    <?php if( true == ampforwp_get_setting('ampforwp-pages-recentpost-excerpt') ){
        					   				$excep_len = 15;
        	                                if(ampforwp_get_setting('ampforwp-pages-recentpost-excerpt-len') && is_numeric(ampforwp_get_setting('ampforwp-pages-recentpost-excerpt-len'))){
        	                                    $excep_len = intval(ampforwp_get_setting('ampforwp-pages-recentpost-excerpt-len'));
        	                                }
                                            amp_loop_excerpt($excep_len);
                                        } ?>
                				<?php if( true == ampforwp_get_setting('ampforwp-pages-recentpost-date')){?>
                                <div class="pg-pt-dt">
                                    <?php amp_loop_date(); ?>
                                </div>
                				<?php }?>
                                </div>
                            </div>
                        <?php endwhile; amp_loop('end');  ?>
                    </div>
                <?php }
				if( ampforwp_get_setting('enable-add-this-option') == true && 'above-content' !=  ampforwp_get_setting('swift-add-this-position')) {
				echo ampforwp_addThis_support();
			}?>
			</div>	
				<?php if( ampforwp_get_setting('gbl-sidebar') == '1' && ampforwp_is_front_page() ){ ?>				
					<div class="<?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>cntr <?php } ?>pgb">
						<div class="cntn-wrp pg-lft">
							<?php amp_content(); ?>
							<?php if(ampforwp_get_comments_status()){ ?>
								<div class="cmts">
									<?php amp_comments();?>
								</div>
							<?php } ?>
						</div>
						<?php if(isset($redux_builder_amp['gbl-sidebar']) && $redux_builder_amp['gbl-sidebar'] == '1'){ ?>
							<div class="sdbr-right"> <?php 
								$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
								$sidebar_output = '';
								if ( $sanitized_sidebar) {
									$sidebar_output = $sanitized_sidebar->get_amp_content();
									$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
								}
					            echo $sidebar_output; // amphtml content, no kses?>
							</div>
						<?php } ?>
					</div><!-- /.cntr -->
				<?php } else { ?>
				<?php if( true == ampforwp_get_setting('gnrl-sidebar') && ampforwp_get_setting('page_sidebar') == '1' && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && !ampforwp_is_front_page()){ ?>
				<?php if ( is_active_sidebar( 'swift-sidebar' ) ) : ?>
				<div class="sdbr-right" style="float: right;" >
					<?php 
					$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
					$sidebar_output = '';
					if ( $sanitized_sidebar) {
						$sidebar_output = $sanitized_sidebar->get_amp_content();
						$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
					}
		            echo do_shortcode($sidebar_output);
					?>
				</div>
			<?php endif; ?>
				<?php } ?>
				<?php } ?>
		</div>
	</div>
</div>
<?php amp_footer()?>
