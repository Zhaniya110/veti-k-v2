<?php get_header(); ?>

<?php while ( have_posts() ) :the_post(); ?>
<div class="front-page">
    <div class="top">
        <div class="slider-top owl-carousel">
                <div class="item">
                    <div class="section-title">
                        <span>Расширяя возможности</span>
                        <span>и ресурсы</span>
                    </div>
                </div>
                <div class="item">
                    <div class="section-title">
                        <span>Раскрывая потенциал</span>
                        <span>и резервы</span>
                    </div>
                </div>
                <div class="item">
                    <div class="section-title">
                        <span>Усиливая мощность</span>
                        <span>и работоспособность</span>
                    </div>
                </div>
        </div>

        <script>
            // $(document).ready(function(){
            //     $('.slider-top').slick({
            //         arrows: false,
            //         dots: true,
            //         autoplay: true,
            //         infinite: true,
            //         autoplaySpeed: 6000,
            //         speed: 0
            //     });
            // });

            var owl = $('.slider-top');
            owl.owlCarousel({
                items:1,
                loop:true,
                margin:0,
                autoplay:true,
                autoplayTimeout:6500,
            });
        </script>

        <div class="container">
            <div class="row">
                <div class="col col-btn">
                    <a href="#home-about" class="button-down"></a>
                </div>

                <div class="col col-auto col-text">
                    <div class="text">Мы помогаем повысить эффективность бизнеса, усиливая команды, меняя поведение людей, указывая цели каждого, команды и компании</div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(window).scroll(function() {
            const
                a = $(this).scrollTop(),
                b = 800;
            $(".front-page .top").css({
                top: a / 1.6 + "px",
                opacity: 1 - a / b
            });
        });

    </script>

    <div class="about" id="home-about" data-parallax="scroll">
        <div class="container">
            <div class="row">
                <div class="col col-image">
                    <img src="<?php echo THEME_URL; ?>image/home-about.png" alt="" class="tri">
                </div>

                <div class="col">
                    <div class="text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <a href="/about-us/" class="link"><span>О нас</span></a>
        </div>
    </div>

    <div class="what-do">
        <div class="container">
            <h2>Что мы делаем</h2>

            <div class="hand">
                <img src="<?php echo THEME_URL; ?>image/hand.png" alt="" class="bobble">
            </div>
            <div class="hand-text">перетащить для большей информации</div>
        </div>

        <div class="slide-what">
            <?php $what_list = get_field('what_list', 14) ?>
            <?php foreach($what_list as $index =>  $item): ?>
                <div>
                    <div class="item" data-url="what-are-we-doing/#accordion-<?php echo $index; ?>">
                        <div class="row align-items-center">
                            <div class="col col-lg col-md col-sm-12 col-12">
                                <div class="text">
                                    <h4><?php echo $item['name'] ?></h4>
                                    <p><?php echo $item['desc'] ?></p>
                                </div>
                            </div>
                            <div class="col col-lg-auto col-md-auto col-sm-12 col-12">
                                <img class="img" src="<?php echo $item['img'] ?>" alt="">
                            </div>
                        </div>

                        <svg width="555" height="550" viewBox="0 0 555 550" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M64.8 115.3L441.1 4.60001C511.4 -16.1 574.8 53.3 548.7 122.4L409 492.1C385.5 554.2 305.5 569.8 260.9 521L24.3 262C-20.3 213.1 1.59998 133.9 64.8 115.3Z" fill="#f2f2f2"/>
                        </svg>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            $(document).ready(function(){
                const slider = $(".slide-what");

                slider.slick({
                    infinite: false,
                    arrows: false,
                    centerPadding: '0',
                    variableWidth: true,
                    accessibility: false,
                    centerMode: true,
                    responsive: [
                        {
                            breakpoint: 1080,
                            settings: {
                                variableWidth: false,
                                centerMode: false,
                            }
                        }
                    ]
                });

                var click_link = false

                slider.on('beforeChange', function(event, slick, currentSlide){
                    click_link = true
                });


                $(".slide-what .item").on('click', function () {
                    if (!click_link){
                        window.location.href = $(this).data('url')
                    }
                })

                slider.on('afterChange', function(event, slick, currentSlide){
                    click_link = false
                });
//
                // var time_out_slide = false
                //
                // slider.on('wheel', (function(e) {
                //     e.preventDefault();
                //
                //     if(!time_out_slide){
                //         time_out_slide = true
                //
                //         if (e.originalEvent.deltaY < 0) {
                //             $(this).slick('slickNext');
                //         } else {
                //             $(this).slick('slickPrev');
                //         }
                //
                //         setTimeout(function () {
                //             time_out_slide = false
                //         }, 1000)
                //
                //     }
                // }));
            });
        </script>
    </div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>