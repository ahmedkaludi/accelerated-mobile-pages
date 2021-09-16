<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
header('Content-Type: ' . esc_attr(feed_content_type('rss2')) . '; charset=' . esc_attr( get_option('blog_charset') ), true);
    $more = 1;
    echo '<?xml version="1.0" encoding="'. esc_attr( get_option('blog_charset') ).'"?'.'>';
?>

<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">

<channel>
    <title><?php bloginfo_rss('name'); ?></title>
    <link><?php bloginfo_rss('url'); ?></link>
    <description><?php bloginfo_rss("description"); ?></description>
    <lastBuildDate><?php echo esc_attr(mysql2date('c', get_lastpostmodified('GMT'), false)); ?></lastBuildDate>
    <language><?php bloginfo_rss( 'language' ); ?></language>
    <?php
    global $redux_builder_amp;
    $number_of_articles = $exclude_ids = '';
    $exclude_cats = array();
    if( isset( $redux_builder_amp['ampforwp-fb-instant-article-posts'] ) && $redux_builder_amp['ampforwp-fb-instant-article-posts'] ){
        $number_of_articles = $redux_builder_amp['ampforwp-fb-instant-article-posts'];
        $number_of_articles = intval( $number_of_articles );
    }
    else{
        $number_of_articles = 50;
    }
    
    $ia_args = array(
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => true,
        'posts_per_page'        => esc_attr($number_of_articles),
        'no_found_rows' => true,
        'meta_query' => array(
            array(
                'key'        => 'ampforwp-ia-on-off',
                'value'      => 'default',
            ),
        )        
    );
    if(ampforwp_get_setting('fb-instant-article-order-by') == 2){
        $ia_args['orderby'] = 'post_modified';
    }
    if ( ampforwp_get_setting('hide-amp-ia-categories') ) {
        $exclude_cats = array_values(array_filter(ampforwp_get_setting('hide-amp-ia-categories')));
        $ia_args['category__not_in'] = $exclude_cats;
    }
    if ( is_category() ) {
        $ia_args['category__in']    = get_queried_object_id(); 
    }
    if ( is_tag() ) {
        $ia_args['tag__in']         = get_queried_object_id();  
    }
    if ( is_tax() ) {
        $tax_object = get_queried_object();
        $ia_args['post_type']               = get_post_type();
        $ia_args['tax_query']['taxonomy']   = esc_attr($tax_object->taxonomy);
        $ia_args['tax_query']['field']      = 'id';
        $ia_args['tax_query']['terms']      = esc_attr($tax_object->term_id);
    }
    $ia_args = apply_filters('ampforwp_ia_query_args' , $ia_args );
    $ia_query = new WP_Query( $ia_args );
    while( $ia_query->have_posts() ) :
        $ia_query->the_post(); ?>

    <item>
        <title><?php the_title_rss() ?></title>
        <link><?php the_permalink_rss() ?></link>
        <guid><?php the_guid(); ?></guid>
        <pubDate><?php echo esc_attr(mysql2date('c', get_post_time('c', true), false)); ?></pubDate>
        <?php if ( true == $redux_builder_amp['ampforwp-instant-article-author-meta'] ) { ?>
            <author><?php the_author() ?></author>
        <?php } ?>
        <description><?php the_excerpt_rss(); ?></description>
        <content:encoded>
            <![CDATA[
                <?php
                $template_file = AMPFORWP_PLUGIN_DIR . 'templates/instant-articles/instant-article.php';
                    load_template($template_file, false);
                ?>
            ]]>
        </content:encoded>
    </item>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</channel>
</rss>