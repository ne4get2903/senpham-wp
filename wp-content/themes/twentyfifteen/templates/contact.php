<?php
/*
Template Name: Contact
*/
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <article class="post-2 page type-page status-publish hentry">
            <div class="">
                <h4>Address</h4>
                <p>Enter your address here</p>
            </div>
            <div class="">
                <?php echo do_shortcode('[contact-form-7 id="74" title="Contact form 1"]');;
                ?>
            </div>
        </article>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>
