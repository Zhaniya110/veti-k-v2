<?php //Template Name: Что мы делаем

get_header() ?>

<?php while (have_posts()) :the_post(); ?>
    <div class="page-what-we-doing">
        <div class="top">
            <div class="container">
                <?php $title = get_field('title'); ?>
                <div class="section-title">
                    <span class="mouse-parallax"><?php echo $title['item_1']; ?></span>
                    <span class="mouse-parallax2"><?php echo $title['item_2']; ?>
                        <i><?php echo $title['item_3']; ?></i>
                        <i><?php echo $title['item_3']; ?></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="info">
            <div class="container">
                <div class="row">
                    <div class="col col-animate col-5">
                        <img class="animate" src="<?php echo THEME_URL; ?>image/what-1.png" alt="">
                    </div>

                    <div class="col col-text">
                        <div class="text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="accordion-container">
            <div class="container">
                <?php $what_list = get_field('what_list') ?>
                <?php foreach($what_list as $index =>  $item): ?>
                    <div class="accordion" id="accordion-<?php echo $index; ?>">
                        <a href="#" class="accordion-title"><?php echo $item['name'] ?><i></i></a>
                        <div class="accordion-content">
                            <div class="item">
                                <div class="row">
                                    <div class="col col-lg-5 col-md-12 col-12 col-image">
                                        <img src="<?php echo $item['img'] ?>" alt="">
                                    </div>

                                    <div class="col col-lg col-md-12 col-12">
                                        <div class="text">
                                            <?php echo $item['text'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <script>
            jQuery(document).ready(function (e) {
                jQuery('.accordion-title').on('click', function () {
                    var $this = jQuery(this);

                    if (!$this.parents('.accordion').hasClass('show')) {
                        jQuery('.accordion').removeClass('show');
                        jQuery('.accordion .accordion-content').slideUp(350);

                        $this.parents('.accordion').toggleClass('show');
                        $this.next('.accordion-content').slideToggle(350);
                    } else {
                        jQuery('.accordion').removeClass('show');
                        jQuery('.accordion .accordion-content').slideUp(350);
                    }

                    return false;
                })
            });


            function openAccordeon(){
                if(location.hash.length <= 1) return;

                if (!jQuery(location.hash).hasClass('show')) {
                    console.log(location.hash)

                    jQuery(location.hash).toggleClass('show');
                    jQuery(location.hash).find('.accordion-content').slideToggle(350);
                }
            }
            window.addEventListener("load", openAccordeon);
            window.addEventListener("hashchange", openAccordeon);
        </script>
    </div>
<?php endwhile; ?>

<?php get_footer() ?>
