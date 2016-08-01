<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php food_entry_header();?>
            <?php food_entry_meta();?>
        </header>
        <div class="entry-thumbnail">
            <?php food_thumbnail('thumbnail');?>
        </div>
        <div class="entry-content">
            <?php food_entry_content();?>
        </div>
</article>