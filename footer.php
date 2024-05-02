<footer>
    <div class="container">
        <div class="row">
            <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="logo"><img src="<?php echo THEME_URL; ?>image/logo.png" alt=""></div>
            </div>

            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <?php
                wp_nav_menu([
                    'menu'       => 'header_ru',
                    'container'  => '',
                    'menu_class' => 'menu',
                    'echo'       => true,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ]);
                ?>
            </div>

            <div class="col col-lg col-md col-sm-12 col-12">
                <div class="contact">
                    <?php the_field('address', 'option'); ?>
                </div>
            </div>
        </div>

        <div class="row row-bottom">
            <div class="col col-9"><div class="copy">Copyright ©2021</div></div>
            <div class="col">
                <div class="social d-flex flex-wrap align-items-center">
                    <?php $social = get_field('social', 'option'); ?>
                    <a href="<?php echo $social['facebook']; ?>" target="_blank"><img src="<?php echo THEME_URL; ?>image/fb.png" alt=""></a>
                    <a href="<?php echo $social['instagram']; ?>" target="_blank"><img src="<?php echo THEME_URL; ?>image/ins.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>