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


    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <p><strong>Title:</strong> <?php echo $title ?></p>
    <p><strong>Count:</strong> <?php echo $count ?></p>
    <p><strong>Selected Category ID:</strong> <?php echo $slected_cat_id ?></p>
    <p><strong>Show Button:</strong> <?php echo $show_button ?></p>

    <?php
    if($slected_cat_id==''){return;}
    $args = array(
        'cat'      => $slected_cat_id,
        'order'    => 'ASC',
        'posts_per_page' => ''.$count
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
    // Declarations for all the values tobe stored
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $selected_category = ! empty( $instance['category'] ) ? $instance['category'] : '';
    $count = ! empty( $instance['count'] ) ? $instance['count'] : '';
    $radio_buttons = esc_attr($instance['showButton']);
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

 echo '<option selected value="none">Select One </option>';

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
          <input class="widefat" id="<?php echo $this->get_field_id('show_button_1'); ?>" name="<?php echo $this->get_field_name('showButton'); ?>" type="radio" value="YES" <?php if($radio_buttons === 'YES'){ echo 'checked="checked"'; } ?> />
          <?php _e(' Yes'); ?>
      </label><br>
      <label for="<?php echo $this->get_field_id('showButton'); ?>">
          <input class="widefat" id="<?php echo $this->get_field_id('show_button_2'); ?>" name="<?php echo $this->get_field_name('showButton'); ?>" type="radio" value="NO" <?php if($radio_buttons === 'NO'){ echo 'checked="checked"'; } ?> />
          <?php _e(' No'); ?>
      </label><br>
    <!-- radio buttons Ends Here -->
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
    return $instance;
  }

}

// Register the widget.
function ampforwp_register_categories_widget() {
  register_widget( 'AMPFORWP_Categories_Widget' );
}
add_action( 'widgets_init', 'ampforwp_register_categories_widget' );

?>