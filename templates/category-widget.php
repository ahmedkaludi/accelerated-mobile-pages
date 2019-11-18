<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class AMPFORWP_Categories_Widget extends WP_Widget {

  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array(
      'classname' => 'ampforwp_categories_widget',
       'description' => esc_html__('This Widget adds categories where necessary in AMP Pages','accelerated-mobile-pages')
     );
    parent::__construct( 'ampforwp_categories_widget', esc_html__('AMP Categories Module','accelerated-mobile-pages'), $widget_options );
  }


// args for the output of the form
  public $args = array(
          'id'            => 'uniqueid',
          'before_title'  => '<h4 class="widgettitle">',
          'after_title'   => '</h4>',
          'before_widget' => '<div class="widget-wrap">',
          'after_widget'  => '</div>'
      );

// Create the widget output.
  public function widget( $args, $instance ) {
    $ampforwp_title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $ampforwp_category_count = $instance[ 'count' ];
    $ampforwp_category_id = $instance[ 'category' ];
    $ampforwp_category_link = $instance[ 'showButton' ];
    $ampforwp_show_excerpt = $instance[ 'showExcerpt' ];

    global $redux_builder_amp;

 //   echo . $args['before_title'] .  . $args['after_title']; ?>

    <?php
    $exclude_ids = ampforwp_exclude_posts();

    $args = array(
        'cat' => $ampforwp_category_id,
        'posts_per_page' => $ampforwp_category_count,
        'post__not_in' => $exclude_ids,
        'has_password' => false,
        'post_status'=> 'publish'
    );
    // The Query
    $the_query = new WP_Query( $args );
    $thumb_url = "";

    // The Loop

    if ( $the_query->have_posts() ) {
        echo '<div class="amp-wp-content amp_cb_module amp-category-block"><ul>';
        echo '<li class="amp_module_title"><span>'.esc_attr($ampforwp_title) .'</span></li>';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $ampforwp_post_url = get_permalink(); ?>
            <li class="amp-category-post">
              <?php if ( ampforwp_has_post_thumbnail() ) {
                  $thumb_url = ampforwp_get_post_thumbnail('url');
                  ?>
                  <a href="<?php echo esc_url(ampforwp_url_controller($ampforwp_post_url));?>"><amp-img  class="ampforwp_wc_shortcode_img"  src=<?php echo esc_url($thumb_url) ?> width=150 height=150 layout="responsive"></amp-img></a>
              <?php } ?>

              <a class="ampforwp_wc_shortcode_title" href="<?php echo ampforwp_url_controller($ampforwp_post_url) ;?>">
                  <?php echo get_the_title(); ?>
              </a> <?php

              if( $ampforwp_show_excerpt == 'yes' ) { ?>
                <div class="ampforwp_wc_shortcode_excerpt"> <?php
                  if( has_excerpt() ) {
                    $content = get_the_excerpt();
                  } else {
                    $content = get_the_content();
                  } ?>
                  <span class="ampforwp_cat_wdgt_excerpt_text"><?php echo wp_trim_words( strip_tags( strip_shortcodes( $content ) ) , 15  ); ?></span>
                </div> <?php
              } ?>

            </li> <?php
        } ?>
        <div class="cb"></div>
        <?php

        //show more link
        if( $ampforwp_category_link === 'yes' && ! empty( $ampforwp_category_id ) ) {
          
          $category_link =  '<a class="amp-category-block-btn" href="'.ampforwp_url_controller(get_category_link( $ampforwp_category_id) ).'">'. esc_html(ampforwp_translation($redux_builder_amp['amp-translator-show-more-text'], 'View More Posts (Widget Button)')).'</a>';
        } else {
          $category_link =   '<a class="amp-category-block-btn" href="'.ampforwp_url_controller( home_url() ).'">'. esc_html(ampforwp_translation($redux_builder_amp['amp-translator-show-more-text'], 'View More Posts (Widget Button)')).'</a>';
        } 
        if( $ampforwp_category_link === 'no' ) {
            $category_link = '';
        }

        echo  $category_link;

        echo '</ul> <div class="cb"></div> </div>';

    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
//   echo $args['after_widget'];
  }


  // Create the admin area widget settings form.
  public function form( $instance ) {

    // Declarations for all the values to be stored
    $ampforwp_title = ! empty( $instance['title'] ) ? $instance['title'] : 'Category Title';
    $selected_category = ! empty( $instance['category'] ) ? $instance['category'] : '';
    $ampforwp_category_count = ! empty( $instance['count'] ) ? $instance['count'] : 3 ;
    $radio_buttons = ! empty( $instance['showButton'] ) ? $instance['showButton'] : 'yes';
    $excerpt_buttons = ! empty( $instance['showExcerpt'] ) ? $instance['showExcerpt'] : 'yes';

    ?>
    <!-- Form Ends Here -->
        <p>
        <!-- text Start Here -->
          <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:','accelerated-mobile-pages') ?>
          <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $ampforwp_title ); ?>" />
          </label><br>
        <!-- text End Here -->
        </p>
        <!-- select Start Here -->
         <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_attr_e('Category:','accelerated-mobile-pages') ?>
          <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>" class="widefat" value>
            <?php

              $categories = get_categories( array(
                  'orderby' => 'name',
                  'order'   => 'ASC',
                  'number'  => 500
              ) );

              echo '<option selected value="none">Recent Posts </option>';
              foreach( $categories as $category ) {
                 echo '<option '. selected( $selected_category, $category->term_id) . ' value="'. esc_attr($category->term_id) . '">' . esc_attr($category->name) . '</option>';
               } ?>
          </select>
          </label>
         </p>
        <!-- select End Here -->

        <p>
        <!-- text starts Here -->
          <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_attr_e('Number of Posts:','accelerated-mobile-pages') ?>
          <input class="widefat" type="number" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr( $ampforwp_category_count ); ?>" />
          </label>
        </p>
        <!-- text End Here -->
        <p>
        <!-- radio buttons starts Here -->
          <label for="<?php echo esc_attr($this->get_field_id( 'showButton' )); ?>" value="<?php  echo esc_attr( $ampforwp_title );?>"><?php esc_attr_e('Show View more Button:','accelerated-mobile-pages') ?></label><br>
          <label for="<?php echo esc_attr($this->get_field_id('show_button_1')); ?>">
              <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_button_1')); ?>" name="<?php echo esc_attr($this->get_field_name('showButton')); ?>" type="radio" value="yes" <?php if($radio_buttons === 'yes'){ echo 'checked="checked"'; } ?> /><?php esc_attr_e('Yes ','accelerated-mobile-pages'); ?>
          </label>
           <label for="<?php echo esc_attr($this->get_field_id('show_button_2')); ?>">
              <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_button_2')); ?>" name="<?php echo esc_attr($this->get_field_name('showButton')); ?>" type="radio" value="no" <?php if($radio_buttons === 'no'){ echo 'checked="checked"'; } ?> /><?php esc_attr_e(' No','accelerated-mobile-pages'); ?>
          </label>
        <!-- radio buttons Ends Here -->
        </p>

        <p>
          <!-- Excerpt related code starts Here -->
            <label for="<?php echo esc_attr($this->get_field_id( 'showExcerpt' )); ?>" value="<?php  echo esc_attr( $ampforwp_title );?>"> <?php esc_attr_e('Show Excerpt:','accelerated-mobile-pages') ?></label><br>
            <label for="<?php echo esc_attr($this->get_field_id('show_button_3')); ?>">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_button_3')); ?>" name="<?php echo esc_attr($this->get_field_name('showExcerpt')); ?>" type="radio" value="yes" <?php if($excerpt_buttons === 'yes'){ echo 'checked="checked"'; } ?> /><?php esc_attr_e('Yes ','accelerated-mobile-pages'); ?>
            </label>
             <label for="<?php echo esc_attr($this->get_field_id('show_button_4')); ?>">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_button_4')); ?>" name="<?php echo esc_attr($this->get_field_name('showExcerpt')); ?>" type="radio" value="no" <?php if($excerpt_buttons === 'no'){ echo 'checked="checked"'; } ?> /><?php esc_attr_e(' No','accelerated-mobile-pages'); ?>
            </label>
          <!-- Excerpt related code Ends Here -->
        </p>
    <!-- Form Ends Here -->

    <?php
  }



  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'count' ] = strip_tags( $new_instance[ 'count' ] );

    if( strip_tags( $new_instance[ 'category' ] ) !== 'none' ) {
      $instance[ 'category' ] = strip_tags( $new_instance[ 'category' ] );
    } else {
      $instance[ 'category' ] = '';
    }
    $instance['showButton'] = strip_tags($new_instance['showButton']);
    $instance['showExcerpt'] = strip_tags($new_instance['showExcerpt']);
    return $instance;
  }

}

// Register the widget.
function ampforwp_register_categories_widget() {
  global $redux_builder_amp;
  if ( isset($redux_builder_amp['amp-design-selector']) && 4 != $redux_builder_amp['amp-design-selector'] ) {
    register_widget( 'AMPFORWP_Categories_Widget' );
  }
}
add_action( 'widgets_init', 'ampforwp_register_categories_widget' );

?>