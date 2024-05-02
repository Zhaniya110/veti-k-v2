<?php get_header() ?>

    <!-- Start site wrapper -->
    <div class="site-wrapper">

    <div class="page-template">
        <section class="section">
            <div class="container">
                <div class="page-header text-center">
                    <h1><?php the_title() ?></h1>
                </div>

                <div class="content">
                    <?php

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </section>
    </div>

<?php get_footer() ?>