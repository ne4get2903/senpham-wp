<?php
/**
  @ Thiết lập các hằng dữ liệu quan trọng
  @ THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
  @ CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
  **/
  define('THEME_URL', get_stylesheet_directory());
  define('CORE', THEME_URL.'/core');

  /**
  @ Load file /core/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/

  require_once( CORE . '/init.php' );
  if(!isset($content_width)){
    $content_width = 620;
  }
  if(!function_exists('food_theme_setup')){
    function food_theme_setup(){

    }
    add_action('init','food_theme_setup');
  }
  /*
* Thiết lập theme có thể dịch được
*/
  $language_folder = THEME_URL.'/languages';
  load_theme_textdomain('food',$language_folder);
  /*
* Tự chèn RSS Feed links trong <head>
*/
  add_theme_support('automatic-feed-links');
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support( 'post-formats',
    array(
       'image',
       'video',
       'gallery',
       'quote',
       'link'
    )
 );
  $default_background = array(
   'default-color' => '#e8e8e8',
);
add_theme_support( 'custom-background', $default_background );
register_nav_menu ( 'primary-menu', __('Primary Menu', 'food.dev') );
$sidebar = array(
   'name' => __('Main Sidebar', 'food'),
   'id' => 'main-sidebar',
   'description' => 'Main sidebar for food theme',
   'class' => 'main-sidebar',
   'before_title' => '<h3 class="widgettitle">',
   'after_title' => '</h3>'
);
register_sidebar( $sidebar );
/**
@ Thiết lập hàm hiển thị logo
@ thachpham_logo()
**/
if ( ! function_exists( 'food_logo' ) ) {
  function food_logo() {?>
    <div class="logo">

      <div class="site-name">
        <?php if ( is_home() ) {
          printf(
            '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'sitename' )
          );
        } else {
          printf(
            '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'sitename' )
          );
        } // endif ?>
      </div>
    </div>
  <?php }
}
if(!function_exists('food_thumbnail')){
    function food_thumbnail($size){
        if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')):
            echo '<figure class="post-thumbnail">'.the_post_thumbnail( $size ).'</firgue>';
        endif;
    }
}

if(!function_exists('food_entry_header')){
    function food_entry_header(){
        if(is_single()):
            //$html = .the_permalink();
            echo '<h1 class="entry_title">
            <a href="'.get_edit_post_link().'">'.get_the_title().'</a>
            </h1>';
        else:
            echo '<h2 class="entry_title">
            <a href="'.get_edit_post_link().'">'.get_the_title().'</a>
            </h2>';
        endif;
    }
}

if(!function_exists('food_entry_meta')){
    function food_entry_meta(){
        if(!is_page()):
            echo '<div class="entry-meta"';
            printf(__('<span class ="author">Posted by %1$s</span>','food'),get_the_author());
            printf( __('<span class="date-published"> at %1$s</span>', 'thachpham'),
            get_the_date() );

            printf( __('<span class="category"> in %1$s</span>', 'thachpham'),
            get_the_category_list( ', ' ) );

        // Hiển thị số đếm lượt bình luận
        if ( comments_open() ) :
          echo ' <span class="meta-reply">';
            comments_popup_link(
              __('Leave a comment', 'thachpham'),
              __('One comment', 'thachpham'),
              __('% comments', 'thachpham'),
              __('Read all comments', 'thachpham')
             );
          echo '</span>';
        endif;
      echo '</div>';
    endif;
    }
}

function food_readmore(){
    return'...<a class="read-more" href="'.get_permalink(get_the_ID()).'">Read More</a>';
}
add_filter('excerpt_more', 'food_readmore');
if(!function_exists('food_entry_content')){
    function food_entry_content(){
        if(!is_single()): the_excerpt();
        else:
            the_content();
        $link_pages = array(
        'before' => __('<p>Page:', 'food'),
        'after' => '</p>',
        'nextpagelink'     => __( 'Next page', 'food' ),
        'previouspagelink' => __( 'Previous page', 'food' )
      );
      wp_link_pages( $link_pages );
      endif;
    }
}
