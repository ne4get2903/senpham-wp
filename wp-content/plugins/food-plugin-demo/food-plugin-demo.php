<?php
/**
* Plugin Name: Food Plugin Demo
<<<<<<< HEAD
* Plugin URI:
* Description: A brief description about your plugin.
* Version: 1.0 or whatever version of the plugin (pretty self explanatory)
* Author: SenPham
* Author URI:
* License: A "Slug" license name e.g. GPL12
*/
if(!class_exists('Food_Plugin_Demo')) {
    class Food_Plugin_Demo {
        function __construct(){
            add_action('init','create_post_type');
            add_action('add_meta_boxes','register_meta_boxes');
            //add_filter('pre_get_posts','get_custom_post_type');
            add_action('save_post','fpd_save_food_meta');
            add_action('wp_enqueue_media','include_media_button_js_file');

        }
    }
}
if( !class_exists('Food_Widget')) {
    class Food_Widget extends WP_Widget {
        function __construct( ) {
            parent::__construct(
                'food_widget', //id
                'Food Widget Demo', //name
                array(
                    'description' => 'THis is widget demo'
                    )
                );
        }
        function form( $instance ) {
            parent::form( $instance );
            $default = array(
                'title' => 'Your name',
                'post_number' => 10
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $title = esc_attr( $instance['title']);
            $post_number = esc_attr( $instance['post_number']);
            echo "Nhập tiêu đề <input class='widefat' type='text' name='".$this->get_field_name("title")."'' value='".$title."' />";
            echo "So luong bai hien thi <input class='widefat' type='text' name='".$this->get_field_name("post_number")."' value='".$post_number."' />";
        }
        function update(  $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['post_number'] = strip_tags( $new_instance['post_number'] );
            return $instance;
        }
        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $post_number= $instance['post_number'];
            echo $before_widget;
            echo $before_title.$title.$after_title;
            $random_query = new WP_Query('posts_per_page='.$post_number.'&orderby=rand');
            if($random_query->have_posts()) :
                echo "<ol>";
            while( $random_query->have_posts() ) :
                $random_query->the_post();
                echo "<li><a href='".get_the_permalink()."' title='".get_the_title()."' > ".get_the_title()."</a></li>";
            endwhile;
            echo "</ol>";
            endif;
            echo $after_widget;
        }
    }
}
function fpd_load() {
	global $fpd;
	$fpd = new Food_Plugin_Demo();
}
add_action('plugins_loaded','fpd_load');

function create_post_type() {
    register_post_type('fpd-food',
        array(
            'labels' => array(
                'name' => 'Foods',
                'singular_name' => 'Food'
            ),
            'taxonomies' => array('category','post_tag'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'has_archive' => true,
            //'publicly_queryable' => true,
            'capability_type' => 'post',
            'supports'           => array( 'title', 'editor', 'thumbnail','post-formats' )//array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','post-formats' )
            ));
}

function register_meta_boxes() {
    add_meta_box('food_detail','Food Detail', 'output_meta_box','fpd-food','normal','high');
}
/*function get_custom_post_type($query){
    if(is_home() && $query->is_main_query()) $query->set('post_type', array('post','fpd-food'));
    return $query;
}*/
/*function add_img1_button(){
    echo '<a href = "#" id="img1" class="button">Add Img 1</a>';
}*/
function include_media_button_js_file() {
    wp_enqueue_script('media_button',plugin_dir_url('food-plugin-demo/js/media_button.js').'media_button.js',array('jquery'), '1.0', true);
}
function output_meta_box( $post,  $metabox ) {
    //wp_editor($post->post_content,'post_content',array('name'=>'post_content'));
    $html = '';
    $html .= '<a href = "#" id="img1" class="button" >Add Img 1</a>
    <a href = "#" id="img2" class="button" >Add Img 2</a>
    <a href = "#" id="img3" class="button" >Add Img 3</a>
    <a href = "#" id="img4" class="button" >Add Img 4</a>';
    $data = (isset($post->ID))?get_post_meta($post->ID):'';
    $arr = wp_upload_dir();
    $nameIn = array();
    $amountIn = array();
    $uploadUrl = $arr['baseurl'];
    $img1 = (isset($data['img1']))?$data['img1'][0]:$uploadUrl.'/No_Image_Available.png';
    $img2 = (isset($data['img2']))?$data['img2'][0]:$uploadUrl.'/No_Image_Available.png';
    $img3 = (isset($data['img3']))?$data['img3'][0]:$uploadUrl.'/No_Image_Available.png';
    $img4 = (isset($data['img4']))?$data['img4'][0]:$uploadUrl.'/No_Image_Available.png';
    $nameIn = (isset($data['name_ingredient']))?unserialize($data['name_ingredient'][0]):'';
    $amountIn = (isset($data['amount_ingredient']))?unserialize($data['amount_ingredient'][0]):'';
    $count = ($nameIn!='')?count($nameIn):0;
    $html .= '<div id="divImg">
    <img class="alignnone size-medium wp-image-29" style="width:150px; height:auto" id="fr_img1" src="'.$img1.'">
    <input type="hidden" id="src_img1" name="src_img1" value="'.$img1.'">
    <img class="alignnone size-medium wp-image-29" style="width:150px; height:auto" id="fr_img2" src="'.$img2.'">
    <input type="hidden" id="src_img2" name="src_img2" value="'.$img2.'">
    <img class="alignnone size-medium wp-image-29" style="width:150px; height:auto" id="fr_img3" src="'.$img3.'">
    <input type="hidden" id="src_img3" name="src_img3" value="'.$img3.'">
    <img class="alignnone size-medium wp-image-29" style="width:150px; height:auto" id="fr_img4" src="'.$img4.'">
    <input type="hidden" id="src_img4" name="src_img4" value="'.$img4.'">
    </div>';

    $html .= '<div id="divIngredient">
    <table class = "wp-list-table widefat fixed striped posts ingredient">

    <tr class="trfirst">
    <th>N.O</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Action</th>
    </tr>

    <tr hidden id="template" class="trIn">
    <td></td>
    <td><input type="text" name="nameIn"></td>
    <td><input type="text" name="amount"></td>
    <td><a class="button deleteIn">X</a></td>
    </tr>';
    for($i= 0; $i<$count; $i++) {
        $html .= '<tr>
        <td>'.($i+1).'</td>
        <td><input type="text" name="nameIn'.($i+1).'" value="'.$nameIn[$i].'"></td>
        <td><input type="text" name="amount'.($i+1).'" value="'.$amountIn[$i].'"></td>
        <td><a class="button deleteIn">X</a></td>
        </tr>';
    }

    $html .= '</table>
    <a class="button" id="newIngredient">New</a>
    <input type="hidden" name="countIn" id="countIn" value="'.$count.'">
    </div>';
    echo $html;
}
function fpd_save_food_meta( $postID ) {
    $metaKey = array();
    $metaKey['img1'] = 'img1';
    $metaKey['img2'] = 'img2';
    $metaKey['img3'] = 'img3';
    $metaKey['img4'] = 'img4';
    $metaKey['name_ingredient'] = 'name_ingredient';
    $metaKey['amount_ingredient'] = 'amount_ingredient';
    $data = array();
    $nameIn = array();
    $amountIn = array();
     /* Get the posted data and sanitize it for use as an HTML class. */
    $data['img1'] = ( isset( $_POST['src_img1'] ) ? sanitize_text_field( $_POST['src_img1'] ) : '' );
    $data['img2'] = ( isset( $_POST['src_img2'] ) ? sanitize_text_field( $_POST['src_img2'] ) : '' );
    $data['img3'] = ( isset( $_POST['src_img3'] ) ? sanitize_text_field( $_POST['src_img3'] ) : '' );
    $data['img4'] = ( isset( $_POST['src_img4'] ) ? sanitize_text_field( $_POST['src_img4'] ) : '' );
    $metaKey['name_ingredient'] = 'name_ingredient';
    $count = ( isset( $_POST['countIn'] ) ? sanitize_text_field( $_POST['countIn'] ) : 0 );
    if($count != 0){
        $index = 0;
        for($i =0; $i < $count; $i++) {
            if(!empty( $_POST['nameIn'.($i+1)] )) {
                    $nameIn[$index] = sanitize_text_field( $_POST['nameIn'.($i+1)] );
                    $amountIn[$index] = sanitize_text_field( $_POST['amount'.($i+1)] );
                    $index = $index+1;
            }
        }
    }
    $data['name_ingredient'] = $nameIn;
    $data['amount_ingredient'] = $amountIn;
    fpd_save_meta_data( $postID, $metaKey, $data );
}

/*function get_custom_post_type($query){
	if(is_home() && $query->is_main_query()) $query->set('post_type', array('post','fpd-food'));
	return $query;
}*/
/*function add_img1_button(){
	echo '<a href = "#" id="img1" class="button">Add Img 1</a>';
}*/
function fpd_save_meta_data( $postID, $metaKey, $newMetaValue ) {
    /* Get the meta value of the custom field key. */
    foreach($metaKey as $key=>$value){
        $metaValue = get_post_meta( $postID, $value, true );
        /* If a new meta value was added and there was no previous value, add it. */

        if ( $newMetaValue[$key] && '' == $metaValue ){
            update_post_meta( $postID, $value, $newMetaValue[$key], true );

        }

        /* If the new meta value does not match the old value, update it. */
        elseif ( $newMetaValue[$key] && $newMetaValue[key] != $metaValue )
            update_post_meta( $postID, $value, $newMetaValue[$key] );

        /* If there is no new meta value but an old value exists, delete it. */
        elseif ( '' == $newMetaValue[$key] && $metaValue )
            delete_post_meta( $postID, $value, $metaValue );
    }
}

function fpd_move_food_detail() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(),'normal',$post);
    unset($wp_meta_boxes['fpd-food']['normal']);
}
add_action('edit_form_after_title', 'fpd_move_food_detail');

add_action('wp_dashboard_setup', 'fpd_create_admin_widget_notice');
function fpd_create_admin_widget_notice() {
    wp_add_dashboard_widget( 'fpd_notice', 'Ghi chu nhac nho', 'fpd_create_admin_widget_notice_callback');
}
function fpd_create_admin_widget_notice_callback(){
    echo "a";
}
add_action( 'widgets_init', 'create_food_widget' );
function create_food_widget(){
    register_widget('Food_Widget');
}