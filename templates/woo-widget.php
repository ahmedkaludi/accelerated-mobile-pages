<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class AMPFORWP_Woo_Widget extends WP_Widget {

  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array(
      'classname'   => 'AMPFORWP_Woo_Widget',
      'description' => esc_html__('This Widget adds Woocommerce Products where necessary in AMP Pages','accelerated-mobile-pages')
     );
    parent::__construct( 'AMPFORWP_Woo_Widget', esc_html__('AMP WooCommerce','accelerated-mobile-pages'), $widget_options );
  }


// args for the output of the form
  public $args = array(
          'before_title'  => '<h4 class="wc_widgettitle">',
          'after_title'   => '</h4>',
          'before_widget' => '<div class="widget-wrap">',
          'after_widget'  => '</div>'
      );

// Create the widget output.
  public function widget( $args,$instance ) {
    // initializing these to avoid debug errors
    global $redux_builder_amp;
    global $woocommerce;

    if( !class_exists( 'WooCommerce' ) ){
      return;
    }
    $ampforwp_title               = apply_filters( 'widget_wc_title', $instance[ 'title' ] );
    $ampforwp_enable_ratings      = $instance[ 'ratings' ];
    $on_sale_logo_on_product      = $instance[ 'on_sale' ];
    $ampforwp_procts_page_link    = $instance[ 'link' ];
    $ampforwp_number_of_products  = $instance[ 'num_of_products' ];
    $ampforwp_show_price          = $instance[ 'show_price' ];

    $exclude_ids = ampforwp_exclude_posts();

     $q = new WP_Query( array(
      'post_type'           => 'product',
      'orderby'             => 'date',
      'post__not_in' 		    => $exclude_ids,
      'has_password'        => false,
      'no_found_rows'          => true,
      'post_status'         => 'publish',
      'posts_per_page'      => esc_attr( $ampforwp_number_of_products )
     ) );

    echo '<h4 class="wc_widgettitle">' . esc_html( $ampforwp_title) . '</h4>';
    echo '<div class="widget-wrap amp-wp-content">' ;

     if ( $q->have_posts() ) : ?>
          <ul class="ampforwp_wc_shortcode"> <?php
           while ( $q->have_posts() ) : $q->the_post();
           global $post;
           global $product;
           if( $ampforwp_procts_page_link === 'amp' ) {
             $ampforwp_post_url = ampforwp_url_controller( get_permalink() );
           } else {
             $ampforwp_post_url = trailingslashit( get_permalink() ) ;
           } ?>
           <li class="ampforwp_wc_shortcode_child"><a href="<?php echo esc_url( $ampforwp_post_url );?>"> <?php

           if ( ampforwp_has_post_thumbnail() ) {
            $thumb_url = ampforwp_get_post_thumbnail('url');
            $thumb_width = ampforwp_get_post_thumbnail('width');
            $thumb_height = ampforwp_get_post_thumbnail('height'); ?>

             <amp-img src='<?php echo esc_url( $thumb_url ); ?>' width="<?php echo esc_attr($thumb_width); ?>" height="<?php echo esc_attr($thumb_height); ?>" layout="responsive"></amp-img> <?php
           }

           if ( $product->is_on_sale() && $on_sale_logo_on_product=='yes' ) { ?>
             <span class="onsale"> <?php echo esc_html__('Sale!','accelerated-mobile-pages') ?> </span> <?php
           } ?>

            <div class="ampforwp-wc-title"> <?php echo get_the_title() ?> </div> <?php
           if (  class_exists( 'WooCommerce' )  ) {
             $amp_product_price	=  $woocommerce->product_factory->get_product()->get_price_html();
             $context           = '';
             $allowed_tags 		  = wp_kses_allowed_html( $context );

             $stock_status = $product->is_in_stock() ? 'InStock' : 'OutOfStock' ;
             if ( $amp_product_price && $stock_status == 'InStock' && $ampforwp_show_price=='yes' ) { ?>
               <div class="ampforwp-wc-price"><?php echo wp_kses( $amp_product_price ,  $allowed_tags  ) ?> </div> <?php
             }

             $rating_count  = $product->get_rating_count();
             $rating        = $product->get_average_rating();

             if (  get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $rating_count  &&  $ampforwp_enable_ratings=='yes' ) {
               $content = '<div class="ampforwp_wc_star_rating" class="star-rating" title="Rated '.$rating.' out of 5' . '">';
               $content .= '<span class="ampforwp_wc_star_rating_text" ><strong>'.$rating.'</strong>'.__(' out of 5 </span>','accelerated-mobile-pages');
               $content .= '</div>';
               echo wp_kses( $content, $allowed_tags );
             }

           }  ?>
           </a></li>
         <?php endwhile; ?>
         </ul>
     <?php endif; ?><?php

     echo '</div>' ;
     /* Restore original Post Data */
     wp_reset_postdata();
}


  // Create the admin area widget settings form.
  public function form( $instance ) {

    // Declarations for all the values to be stored
    $ampforwp_title               =  ! empty( $instance['title'] ) ? $instance['title'] : 'Woocommerce Title';
    $ampforwp_enable_ratings      = ! empty( $instance['ratings'] ) ? $instance['ratings'] : 'yes';
    $on_sale_logo_on_product      = ! empty( $instance['on_sale'] ) ? $instance['on_sale'] : 'yes';
    $ampforwp_show_price          = ! empty( $instance['show_price'] ) ? $instance['show_price'] : 'yes';
    $ampforwp_procts_page_link    = ! empty( $instance['link'] ) ? $instance['link'] : 'noamp';
    $ampforwp_number_of_products  = ! empty( $instance['num_of_products'] ) ? $instance['num_of_products'] : 3; ?>
    <!-- Form Starts Here -->
        <p>
        <!-- text Start Here -->
          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"> <?php echo esc_html__('Title:','accelerated-mobile-pages') ?>
          <input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_html( $ampforwp_title ); ?>" />
          </label><br>
        <!-- text End Here -->
        </p>

        <!-- number input starts Here -->
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'num_of_products' ) ); ?>"><?php echo esc_html__('Number of Products:','accelerated-mobile-pages') ?>
          <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'num_of_products' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_of_products' ) ); ?>" value="<?php echo esc_attr( $ampforwp_number_of_products ); ?>" />
          </label>
        </p>
        <!-- number input End Here -->

        <p>
        <!-- radio buttons starts Here -->
          <label for="<?php echo esc_attr($this->get_field_id( 'ratings' ) ); ?>" value="<?php  echo esc_attr( $ampforwp_enable_ratings );?>"><?php echo esc_html__('Enable Ratings:','accelerated-mobile-pages') ?> </label><br>
          <label for="<?php echo esc_attr( $this->get_field_id('ratings_1') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('ratings_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ratings') ); ?>" type="radio" value="yes" <?php if($ampforwp_enable_ratings === 'yes'){ echo 'checked="checked"'; } ?> /><?php echo esc_html__('Yes ','accelerated-mobile-pages'); ?>
          </label>
           <label for="<?php echo esc_attr( $this->get_field_id('ratings_2') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('ratings_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ratings') ); ?>" type="radio" value="no" <?php if($ampforwp_enable_ratings === 'no'){ echo esc_attr( 'checked="checked"' ); } ?> /><?php echo esc_html__(' No','accelerated-mobile-pages'); ?>
          </label>
        <!-- radio buttons Ends Here -->
        </p>

        <p>
        <!-- radio buttons starts Here -->
          <label for="<?php echo esc_attr( $this->get_field_id( 'on_sale' ) ); ?>" value="<?php  echo esc_attr( $on_sale_logo_on_product );?>"><?php echo esc_html__('Show On Sale:','accelerated-mobile-pages') ?> </label><br>
          <label for="<?php echo esc_attr( $this->get_field_id('on_sale_1') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('on_sale_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('on_sale') ); ?>" type="radio" value="yes" <?php if( $on_sale_logo_on_product === 'yes'){ echo esc_attr('checked="checked"' ); } ?> /><?php echo esc_html__('Yes ','accelerated-mobile-pages'); ?>
          </label>
           <label for="<?php echo esc_attr( $this->get_field_id('on_sale_2') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('on_sale_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('on_sale') ); ?>" type="radio" value="no" <?php if($on_sale_logo_on_product === 'no'){ echo 'checked="checked"'; } ?> /><?php echo esc_html__(' No','accelerated-mobile-pages'); ?>
          </label>
        <!-- radio buttons Ends Here -->
        </p>

        <p>
        <!-- radio buttons starts Here -->
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>" value="<?php  echo esc_attr( $ampforwp_show_price );?>"> <?php echo esc_html__('Show Price:','accelerated-mobile-pages') ?></label><br>
          <label for="<?php echo esc_attr( $this->get_field_id('show_price_1') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_price_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_price') ); ?>" type="radio" value="yes" <?php if($ampforwp_show_price === 'yes'){ echo esc_attr( 'checked="checked"' ); } ?> /><?php echo esc_html__('Yes ','accelerated-mobile-pages'); ?>
          </label>
           <label for="<?php echo esc_attr( $this->get_field_id('show_price_2') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_price_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_price') ); ?>" type="radio" value="no" <?php if($ampforwp_show_price === 'no'){ echo esc_attr( 'checked="checked"' ); } ?> /><?php echo esc_html__(' No','accelerated-mobile-pages'); ?>
          </label>
        <!-- radio buttons Ends Here -->
        </p>
        <p>
        <!-- radio buttons starts Here -->
          <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" value="<?php echo esc_attr( $ampforwp_procts_page_link );?>"><?php echo esc_html__('Show View more Button:','accelerated-mobile-pages') ?> </label><br>
          <label for="<?php echo esc_attr( $this->get_field_id('link_1') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link') ); ?>" type="radio" value="amp" <?php if($ampforwp_procts_page_link === 'amp'){ echo esc_attr( 'checked="checked"' ); } ?> /><?php echo esc_html__('AMP ','accelerated-mobile-pages'); ?>
          </label>
           <label for="<?php echo esc_attr( $this->get_field_id('link_2') ); ?>">
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link') ); ?>" type="radio" value="noamp" <?php if($ampforwp_procts_page_link === 'noamp'){ echo esc_attr( 'checked="checked"' ); } ?> /><?php echo esc_html__(' Non AMP','accelerated-mobile-pages'); ?>
          </label>
        <!-- radio buttons Ends Here -->
        </p>


    <!-- Form Ends Here -->

    <?php
  }
  
  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'num_of_products' ] = strip_tags( $new_instance[ 'num_of_products' ] );
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['show_price'] = strip_tags($new_instance['show_price']);
    $instance['on_sale'] = strip_tags($new_instance['on_sale']);
    $instance['ratings'] = strip_tags($new_instance['ratings']);

    return $instance;
  }

}

// Register the widget.
function ampforwp_register_woo_widget() {
    if ( class_exists( 'WooCommerce' ) ) {
        register_widget( 'AMPFORWP_Woo_Widget' );
    }
}
add_action( 'widgets_init', 'ampforwp_register_woo_widget' );
?>