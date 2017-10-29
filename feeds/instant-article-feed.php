<?php header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
    $more = 1;

    echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>

<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">

<channel>
    <title><?php bloginfo_rss('name'); ?></title>
    <link><?php bloginfo_rss('url') ?></link>
    <description><?php bloginfo_rss("description") ?></description>
    <lastBuildDate><?php echo mysql2date('c', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <language><?php bloginfo_rss( 'language' ); ?></language>

    <?php
        global $redux_builder_amp;
        $number_of_articles = '';
        if( isset( $redux_builder_amp['ampforwp-fb-instant-article-posts'] ) && $redux_builder_amp['ampforwp-fb-instant-article-posts'] ){
            $number_of_articles = $redux_builder_amp['ampforwp-fb-instant-article-posts'];
            $number_of_articles = round( abs( floatval( $number_of_articles ) ) );
        }
        else{
            $number_of_articles = -1;
        }
        $args = array(
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $number_of_articles
        );
        $query = new WP_Query( $args );
        while( $query->have_posts() ) :

            $query->the_post();
    ?>

    <item>
        <title><?php the_title_rss() ?></title>
        <link><?php the_permalink_rss() ?></link>
        <guid><?php the_guid(); ?></guid>
        <pubDate><?php echo mysql2date('c', get_post_time('c', true), false); ?></pubDate>
        <author><?php the_author() ?></author>
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
</channel>
</rss>