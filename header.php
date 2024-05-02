<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title><?php wp_title(''); ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <?php wp_head() ?>
</head>
<body class="<?php body_class(); ?>">

<header>
    <div class="container">
        <div class="row align-items-center justify-content-md-between">
            <div class="col col-lg-3 col-md-3 col-sm-auto">
                <a href="<?php echo home_url(); ?>"><img src="<?php echo THEME_URL; ?>image/logo.png" alt=""></a>
            </div>

            <div class="col col-6 col-menu menu-mobile">
                <?php
                wp_nav_menu([
                    'menu'       => 'header_ru',
                    'container'  => '',
                    'menu_class' => 'menu d-flex flex-wrap align-items-center',
                    'echo'       => true,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ]);
                ?>

                <div class="close-menu">
                    <img src="<?php echo THEME_URL; ?>image/close.svg" alt="">
                </div>
            </div>

            <div class="col col-lg-3 col-md-3 col-sm-auto">
                <div class="lang">
                    <div class="list">
                        <?php $translations = pll_the_languages(array('raw'=>1)); ?>
                        <?php foreach($translations as $index =>  $item): ?>
                            <?php if($item['current_lang']): ?>
                                <div class="active"><?php echo $item['slug'] ?></div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php $translations = pll_the_languages(array('raw'=>1, 'hide_current' => 1)); ?>
                        <?php foreach($translations as $index =>  $item): ?>
                            <a href="<?php echo $item['url'] ?>"><?php echo $item['slug'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col col-auto col-menu-show burger-menu">
                <img src="<?php echo THEME_URL; ?>image/menu.svg" alt="">
            </div>
        </div>
    </div>
</header>
