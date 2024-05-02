<?php //Template Name: О нас

get_header() ?>

<?php while (have_posts()) :the_post(); ?>
    <div class="page-about">
        <div class="top">
            <div class="container">
                <div class="section-title">
                    <span class="mouse-parallax"><?php the_title(); ?></span>
                    <span class="mouse-parallax2"><?php the_title(); ?></span>
                </div>
                <a href="#experience" class="button-down"></a>

                <img class="animate" src="<?php echo THEME_URL; ?>image/about-1.png" alt="">
            </div>
        </div>

        <div class="experience" id="experience">
            <div class="container">
                <div class="row">
                    <div class="col col-animate col-5">
                        <img class="animate" src="<?php echo THEME_URL; ?>image/about-2.png" alt="">
                    </div>

                    <div class="col">
                        <div class="text wow fadeInUp">
                            <?php the_content(); ?>
                        </div>

                        <div class="figures" style="display: none">
                            <div class="row">
                                <?php $list = get_field('about_list') ?>
                                <?php foreach($list as $index =>  $item): ?>
                                    <div class="col col-6 wow bounceIn" data-wow-delay="<?php echo (0.3*$index) ?>s">
                                        <h3><?php echo $item['data'] ?></h3>
                                        <p><?php echo $item['name'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="projects">
            <div class="container">
                <h2>Наши проекты</h2>

                <div class="projects-list">
                    <?php $projects = get_field('projects') ?>
                    <?php foreach($projects as $index => $item): ?>
                        <div class="accordion" id="accordion-<?php echo $index; ?>">
                            <a href="#" class="accordion-title"><?php echo $item['name'] ?><i></i></a>
                            <div class="accordion-content">
                                <div class="item">
                                    <div class="text">
                                        <?php echo $item['text'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <div class="our-team">
            <div class="container">
                <h2><?php pll_e('Наша команда');?></h2>
            </div>

            <div class="slider-our-team">
                <?php $about_team = get_field('about_team') ?>
                <?php foreach($about_team as $index =>  $item): ?>
                    <div>
                        <div class="item">
                            <img src="<?php echo $item['foto'] ?>" alt="">
                            <div class="info">
                                <h3><?php echo $item['name'] ?></h3>
                                <p><?php echo $item['data'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <script>
            $(document).ready(function(){
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


                $('.slider-our-team').slick({
                    arrows: false,
                    dots: true,
                    centerMode: true,
                    infinite: true,
                    centerPadding: '0',
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    responsive: [
                        {
                            breakpoint: 1920,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 1600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 1080,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '0',
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });
            })
        </script>

        <script>
            new WOW().init();
        </script>
    </div>
<?php endwhile; ?>

<?php get_footer() ?>
