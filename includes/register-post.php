<?php
add_action( 'init', 'action_register_post_type_init' );

function action_register_post_type_init() {
    $labels = array(
        'name' => 'Акции',
        'singular_name' => 'Акции', // админ панель Добавить->Функцию
        'add_new' => 'Добавить товар',
        'add_new_item' => 'Добавить товар', // заголовок тега <title>
        'edit_item' => 'Редактировать',
        'new_item' => 'Новая запись',
        'all_items' => 'Все товары',
        'view_item' => 'Просмотр на сайте',
        'search_items' => 'Искать',
        'not_found' =>  'Записей не найдено.',
        'not_found_in_trash' => 'В корзине пусто.',
        'menu_name' => 'Акции' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'dashicons-carrot', // иконка в меню
        'menu_position' => 8, // порядок в меню
        'supports' => array('title', 'thumbnail')
    );
    register_post_type('action', $args);
}
add_action( 'init', 'action_block_register_post' );

function action_block_register_post() {
    $labels = array(
        'name' => 'Блоки',
        'singular_name' => 'Блоки', // админ панель Добавить->Функцию
        'add_new' => 'Добавить блок',
        'add_new_item' => 'Добавить блок', // заголовок тега <title>
        'edit_item' => 'Редактировать',
        'new_item' => 'Новая запись',
        'all_items' => 'Блоки',
        'view_item' => 'Просмотр на сайте',
        'search_items' => 'Искать',
        'not_found' =>  'Записей не найдено.',
        'not_found_in_trash' => 'В корзине пусто.',
        'menu_name' => 'Блоки' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'show_in_menu' => 'edit.php?post_type=action', // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'dashicons-carrot', // иконка в меню
        'menu_position' => 8, // порядок в меню
        'supports' => array('title')
    );
    register_post_type('action_blocks', $args);
}




add_action( 'init', 'drink_register_post_type_init' );

function drink_register_post_type_init() {
    $labels = array(
        'name' => 'Напитки',
        'singular_name' => 'Напиток', // админ панель Добавить->Функцию
        'add_new' => 'Добавить напиток',
        'add_new_item' => 'Добавить новую запись', // заголовок тега <title>
        'edit_item' => 'Редактировать',
        'new_item' => 'Новая запись',
        'all_items' => 'Все напитки',
        'view_item' => 'Просмотр на сайте',
        'search_items' => 'Искать',
        'not_found' =>  'Записей не найдено.',
        'not_found_in_trash' => 'В корзине пусто.',
        'menu_name' => 'Напитки' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'dashicons-carrot', // иконка в меню
        'menu_position' => 7, // порядок в меню
        'supports' => array('title', 'thumbnail')
    );
    register_post_type('drink', $args);
}


add_action( 'init', 'burger_register_post_type_init' );

function burger_register_post_type_init() {
    $labels = array(
        'name' => 'Бургеры',
        'singular_name' => 'Бургер', // админ панель Добавить->Функцию
        'add_new' => 'Добавить бургер',
        'add_new_item' => 'Добавить новую запись', // заголовок тега <title>
        'edit_item' => 'Редактировать',
        'new_item' => 'Новая запись',
        'all_items' => 'Все бургеры',
        'view_item' => 'Просмотр на сайте',
        'search_items' => 'Искать',
        'not_found' =>  'Записей не найдено.',
        'not_found_in_trash' => 'В корзине пусто.',
        'menu_name' => 'Бургеры' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'dashicons-store', // иконка в меню
        'menu_position' => 5, // порядок в меню
        'supports' => array('title', 'thumbnail')
    );
    register_post_type('burger', $args);
}

add_action( 'init', 'chop_register__taxonomy' );

function chop_register__taxonomy(){
    register_taxonomy('chop', array('burger'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Котлеты',
            'singular_name'     => 'Котлета',
            'search_items'      => 'Найти',
            'all_items'         => 'Все',
            'view_item '        => 'Смотреть',
            'parent_item'       => 'Родительская',
            'parent_item_colon' => 'Родительская',
            'edit_item'         => 'Изменить',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить',
            'new_item_name'     => 'Новое имя',
            'menu_name'         => 'Котлеты',
        ),
        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'hierarchical'          => true,
        'rewrite'               => true,
    ) );
}


add_action( 'init', 'taste_register__taxonomy' );

function taste_register__taxonomy(){
    register_taxonomy('taste', array('burger'), array(
        'label'                 => '',
        'labels'                => array(
            'name'              => 'Ингредиенты',
            'singular_name'     => 'Ингредиент',
            'search_items'      => 'Найти',
            'all_items'         => 'Все',
            'view_item '        => 'Смотреть',
            'parent_item'       => 'Родительская',
            'parent_item_colon' => 'Родительская',
            'edit_item'         => 'Изменить',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить',
            'new_item_name'     => 'Новое имя',
            'menu_name'         => 'Ингредиенты',
        ),
//        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'hierarchical'          => true,
        'rewrite'               => true,
        'show_in_menu'               => true,
    ) );
}

function remove_post_custom_fields() {
    remove_meta_box( 'tastediv' , 'burger' , 'normal' );
}

add_action( 'admin_menu' , 'remove_post_custom_fields' );
