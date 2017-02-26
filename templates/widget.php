<?php

class AMPFORWP_Categories_Widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array(
      'classname' => 'ampforwp_categories_widget',
       'description' => 'This Widget adds categories where necessary in AMP Pages'
     );
    parent::__construct( 'ampforwp_categories_widget', 'AMP Categories', $widget_options );
  }


// args for the output of the form
  public $args = array(
          'before_title'  => '<h4 class="widgettitle">',
          'after_title'   => '</h4>',
          'before_widget' => '<div class="widget-wrap">',
          'after_widget'  => '</div></div>'
      );

  // Create the widget output.
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $count = apply_filters( 'post_count', $instance[ 'count' ] );
    $slected_cat_id = apply_filters( 'selected_category', $instance[ 'category' ] );
    $show_button = apply_filters( 'show_button', $instance[ 'showButton' ] );
    $clr_txt = apply_filters( 'color_background', $instance[ 'colorBackground' ] );
    $clr_bckgrnd = apply_filters( 'color_text', $instance[ 'colorText' ] );


    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <p><strong>Title:</strong> <?php echo $title ?></p>
    <p><strong>Count:</strong> <?php echo $count ?></p>
    <p><strong>Selected Category ID:</strong> <?php echo $slected_cat_id ?></p>
    <p><strong>Show Button:</strong> <?php echo $show_button ?></p>
    <p><strong>Text Color:</strong> <?php echo $clr_txt ?></p>
    <p><strong>Background Color:</strong> <?php echo $clr_bckgrnd ?></p>

    <?php

    $exclude_ids = get_option('ampforwp_exclude_post');

    $args = array(
        'cat'      => $slected_cat_id,
        'order'    => 'ASC',
        'posts_per_page' => ''.$count,
        'post__not_in' 		  => $exclude_ids,
        'has_password' => false ,
        'post_status'=> 'publish'
    );
    // The Query
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<ul>';
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          echo '<li>' . get_the_title() . '</li>';
        }
        echo '</ul>';
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
   echo $args['after_widget'];
  }


  // Create the admin area widget settings form.
  public function form( $instance ) {

    // Declarations for all the values to be stored
    $title = ! empty( $instance['title'] ) ? $instance['title'] : 'title';
    $selected_category = ! empty( $instance['category'] ) ? $instance['category'] : '';
    $count = ! empty( $instance['count'] ) ? $instance['count'] : '5';
    $radio_buttons = ! empty( $instance['showButton'] ) ? $instance['showButton'] : 'yes';
    $color_text = ! empty( $instance['colorText'] ) ? $instance['colorText'] : '000000';
    $color_background = ! empty( $instance['colorBackground'] ) ? $instance['colorBackground'] : '000000';

    ?>
    <!-- Form Ends Here -->
        <p>
        <!-- text Start Here -->
          <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
          </label><br>
        <!-- text End Here -->

        <!-- select Start Here -->
          <label  for="<?php echo $this->get_field_id( '

          2' ); ?>">Category:
          <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" value>
            <?php

              $categories = get_categories( array(
                  'orderby' => 'name',
                  'order'   => 'ASC'
              ) );

              echo '<option selected value="none">Recent Posts </option>';
              foreach( $categories as $category ) {
                 echo '<option '. selected( $instance['category'], $category->term_id) . ' value="'. $category->term_id . '">' . $category->name . '</option>';
               } ?>
          </select>
          </label><br>
        <!-- select End Here -->

        <!-- text starts Here -->
          <label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of Posts:
          <input class="widefat" type="number" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" />
          </label><br>
        <!-- text End Here -->

        <!-- radio buttons starts Here -->
          <label for="<?php echo $this->get_field_id( 'showButton' ); ?>" value="<?php  echo esc_attr( $title );?>">Show View more Button:</label><br>
          <label for="<?php echo $this->get_field_id('showButton'); ?>">
              <input class="widefat" id="<?php echo $this->get_field_id('show_button_1'); ?>" name="<?php echo $this->get_field_name('showButton'); ?>" type="radio" value="yes" <?php if($radio_buttons === 'yes'){ echo 'checked="checked"'; } ?> />
              <?php _e(' Yes'); ?>
          </label><br>
          <label for="<?php echo $this->get_field_id('showButton'); ?>">
              <input class="widefat" id="<?php echo $this->get_field_id('show_button_2'); ?>" name="<?php echo $this->get_field_name('showButton'); ?>" type="radio" value="no" <?php if($radio_buttons === 'no'){ echo 'checked="checked"'; } ?> />
              <?php _e(' No'); ?>
          </label><br>
        <!-- radio buttons Ends Here -->

        <!-- Color Picker for Title and show more background Starts Here -->
          <label for="<?php echo $this->get_field_id( 'colorText' ); ?>">Text Color:
            <input class="widefat" type="color" id="<?php echo $this->get_field_id( 'colorText' ); ?>"
            name="<?php echo $this->get_field_name( 'colorText' ); ?>" value="<?php echo esc_attr( $color_text ); ?>" >
          </label><br>
          <label for="<?php echo $this->get_field_id( 'colorBackground' ); ?>">Text Color:
            <input class="widefat" type="color" id="<?php echo $this->get_field_id( 'colorBackground' ); ?>"
            name="<?php echo $this->get_field_name( 'colorBackground' ); ?>" value="<?php echo esc_attr( $color_background ); ?>" >
          </label><br>
        <!-- Color Picker for Title and show more background Ends Here -->
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
    $instance['colorBackground'] = strip_tags($new_instance['colorBackground']);
    $instance['colorText'] = strip_tags($new_instance['colorText']);
    return $instance;
  }

}

// Register the widget.
function ampforwp_register_categories_widget() {
  register_widget( 'AMPFORWP_Categories_Widget' );
}
add_action( 'widgets_init', 'ampforwp_register_categories_widget' );

?>