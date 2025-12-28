<?php

define('THEME_URL', esc_url(get_template_directory_uri()));

function theme_setup(){
    //ブロックエディターへ「style.css」を読み込み
    add_theme_support( 'editor-styles' );
    add_editor_style('style.css');
}

add_action( 'after_setup_theme', 'theme_setup');

function setup_css() {
    //フロントへ「style.css」を読み込み
    wp_enqueue_style( 'style', THEME_URL . '/style.css', false, false, '');
}
add_action('wp_enqueue_scripts', 'setup_css');

// initフックでカスタム投稿タイプの登録関数を呼び出す
// add_action( 'init', 'create_custom_post_type' );

// jsファイルを読み込む
function enqueue_custom_files() {
  wp_deregister_script('jquery');
  // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.1.js');
  wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js');
  wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_files');


// contactform7でラジオボタンを必須にする
function wpcf7_add_shortcode_radio_required() {
  wpcf7_add_shortcode( array( 'radio*' ), 'wpcf7_checkbox_form_tag_handler', true );
}
add_action( 'wpcf7_init', 'wpcf7_add_shortcode_radio_required' );
add_filter( 'wpcf7_validate_radio*', 'wpcf7_checkbox_validation_filter', 10, 2 );

// 外からIDが見えないようにする
add_filter( 'author_rewrite_rules', '__return_empty_array' );
function disable_author_archive() {
if(isset($_GET['author']) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
wp_redirect( home_url( '/404.php' ) );
exit;
}
}
add_action('init', 'disable_author_archive');

// 外からユーザーが見えないようにする
function my_filter_rest_endpoints( $endpoints ) {
  if ( isset( $endpoints['/wp/v2/users'] ) ) {
      unset( $endpoints['/wp/v2/users'] );
  }
  if ( isset( $endpoints['/wp/v2/users/(?P[\d]+)'] ) ) {
      unset( $endpoints['/wp/v2/users/(?P[\d]+)'] );
  }
  return $endpoints;
}
add_filter( 'rest_endpoints', 'my_filter_rest_endpoints', 10, 1 );

