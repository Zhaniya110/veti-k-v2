<?php
//Template Name: Контакты

get_header() ?>

<div class="page-contacts">
    <div class="container">
        <?php while ( have_posts() ) :the_post(); ?>
            <div class="section-title">
                <span class="mouse-parallax"><?php the_title(); ?></span>
                <span class="mouse-parallax2"><?php the_title(); ?></span>
            </div>

            <div class="row">
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="contact-data">
                        <div class="city"><?php the_field('city'); ?></div>
                        <div class="phone"><?php the_field('tel'); ?></div>
                        <div class="address"><?php the_field('data'); ?></div>

                        <div class="social d-flex flex-wrap align-items-center">
                            <?php $social = get_field('social', 'option'); ?>
                            <a href="<?php echo $social['facebook']; ?>" target="_blank"><img src="<?php echo THEME_URL; ?>image/fb.png" alt=""></a>
                            <a href="<?php echo $social['instagram']; ?>" target="_blank"><img src="<?php echo THEME_URL; ?>image/ins.png" alt=""></a>
                        </div>

                        <img class="animate" src="<?php echo THEME_URL; ?>image/contact-1.png" alt="">
                    </div>
                </div>

                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="contact-form">
                        <?php echo do_shortcode('[contact-form-7 id="26" title="Контактная форма 1"]'); ?>
                        <div class="msg-send" id="msg-send"><?php pll_e('Спасибо! Ваше сообщение успешно отправлено. Мы свяжемся с вами в скором времени.'); ?></div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        $('.contact-form').addClass('contact-form-msg-send');
        $('.wpcf7').hide();
        $('#msg-send').fadeIn(200);
    }, false );
</script>
<?php get_footer() ?>
