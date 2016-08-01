<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress

 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <?php $args = array(
            'post_type' => 'fpd-food',
            'post_date' => 'ASC');
        $the_query = new WP_query($args);
        if ( $the_query->have_posts() ) : ?>

            <?php
            // Start the loop.
            while ( $the_query->have_posts() ) : $the_query->the_post();
                /*$data = array();
                $data = get_post_meta($post->ID);
                echo "<div width='300px' height='200px'>";
                <img src='".wp_get_attachment_url( get_post_thumbnail_id($post->ID) )."' width='300px' height='200px'><br>
                <a href='".get_edit_post_link($post->ID)."'>Link</a>
                </div>";*/
                get_template_part( 'content', get_post_format() );
            endwhile;
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
                'next_text'          => __( 'Next page', 'twentyfifteen' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
            ) );

        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>
