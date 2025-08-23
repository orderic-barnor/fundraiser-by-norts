<?php get_header(); ?>

<!-- Hero section -->
<div class="owl-carousel-wrapper">
    <div class="box-92819">
        <!-- <h1 class="text-white mb-3"><?php // bloginfo('description'); 
                                            ?></h1> -->
        <h1 class="text-white mb-3">Rejoignez le mouvement pour un nouvel avenir en Afrique</h1>
        <p><a href="#" class="btn btn-primary py-3 px-4 rounded-0">Faites un don</a></p>
    </div>

    <div class="owl-carousel owl-1 ">
        <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/hero_1.jpg');"></div>
        <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/hero_2.jpg');"></div>
        <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/hero_3.jpg');"></div>
    </div>
</div>

<!-- Section secteurs d'interventions -->
<div class="container">
    <div class="feature-29192-wrap d-md-flex" style="margin-top: -20px; position: relative; z-index: 2;">

        <a href="#" class="feature-29192 overlay-danger" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img_3_gray.jpg');">
            <div class="text">
                <span class="meta">Économie</span>
                <h3 class="text-cursive text-white h1">Autonomisation économique</h3>
            </div>
        </a>

        <a class="feature-29192 overlay-success" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img_patrimoine.jpg');">
            <div class="text">
                <span class="meta">Culture</span>
                <h3 class="text-cursive text-white h1">Valorisation patrimoine</h3>
            </div>
        </a>

        <div class="feature-29192 overlay-warning" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img_bien_etre.jpg');">
            <div class="text">
                <span class="meta">Santé</span>
                <h3 class="text-cursive text-white h1">Bien-être populations</h3>
            </div>
        </div>

    </div>
</div>


<!-- Section causes (exemple avec articles WP) -->
<div class="site-section">
    <div class="container">
        <div class="row mb-5 align-items-st">
            <div class="col-md-4">
                <div class="heading-20219">
                    <h2 class="title text-cursive">Les dernières causes</h2>
                </div>
            </div>
            <div class="col-md-8">
                <p>Nos dernières causes à soutenir</p>
            </div>
        </div>

        <div class="row">
            <?php
            $args = array('post_type' => 'post', 'posts_per_page' => 3);
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-4">
                        <div class="cause shadow-sm">
                            <a href="<?php the_permalink(); ?>" class="cause-link d-block">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/default_cause.jpg" alt="Image" class="img-fluid default-thumbnail">
                                <?php endif; ?>
                            </a>
                            <div class="px-3 pt-3 border-top-0 border border shadow-sm">
                                <h3 class="mb-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="py-2"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<div class="bg-image overlay site-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/hero_1.jpg');">
    <div class="container">

        <div class="row align-items-center">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-md-7">
                        <div class="heading-20219">
                            <h2 class="title text-white mb-4 text-cursive">Nos objectifs</h2>
                            <p class="text-white">INA-AFRICA œuvre pour l’inclusion sociale, le développement durable et la promotion du patrimoine culturel africain à travers des projets concrets et structurants.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="feature-29012 d-flex">
                            <div class="number mr-4"><span>1</span></div>
                            <div>
                                <h3>Autonomisation & Emploi</h3>
                                <p>Contribuer à l’autonomisation économique des femmes, au bien-être social et à l’insertion socio-professionnelle des jeunes via le Programme Jeune Professionnel.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="feature-29012 d-flex">
                            <div class="number mr-4"><span>2</span></div>
                            <div>
                                <h3>Égalité & Genre</h3>
                                <p>Œuvrer à la réduction des inégalités entre les sexes et promouvoir l’approche genre dans tous les pays en développement.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-5">
                        <div class="feature-29012 d-flex">
                            <div class="number mr-4"><span>3</span></div>
                            <div>
                                <h3>Culture & Patrimoine</h3>
                                <p>Promouvoir la culture béninoise et africaine à travers des projets structurants de valorisation du patrimoine national et africain.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="feature-29012 d-flex">
                            <div class="number mr-4"><span>4</span></div>
                            <div>
                                <h3>Environnement & Santé</h3>
                                <p>Participer à la lutte contre le réchauffement climatique, assurer une gestion durable des écosystèmes et contribuer à la santé et au bien-être des populations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="heading-20219 mb-5">
            <h2 class="title text-cursive">Latest Event</h2>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="event-29191 mb-5">
                    <a href="#" class="d-block mb-3"><img src="<?php echo get_template_directory_uri(); ?>/images/img_1.jpg" alt="Image" class="img-fluid rounded"></a>
                    <div class="px-3 d-flex">

                        <div class="bg-primary p-3 d-inline-block text-center rounded mr-4 date">
                            <span class="text-white h3 m-0 d-block">22</span>
                            <span class="text-white small">Oct 2019</span>
                        </div>

                        <div>
                            <div class="mb-3">
                                <span class="mr-3"> <span class="icon-clock-o mr-2 text-muted"></span>9:30 AM &mdash; 11:30 AM</span>
                                <span> <span class="icon-room mr-2 text-muted"></span>Ghana Africa</span>
                            </div>
                            <h3><a href="single.html">Ratione Delectus Assumenda Rem Modi Quaerat Laborum</a></h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="event-29191 mb-5">
                    <a href="#" class="d-block mb-3"><img src="<?php echo get_template_directory_uri(); ?>/images/img_2.jpg" alt="Image" class="img-fluid rounded"></a>
                    <div class="px-3 d-flex">
                        <div class="bg-primary p-3 d-inline-block text-center rounded mr-4 date">
                            <span class="text-white h3 m-0 d-block">22</span>
                            <span class="text-white small">Oct 2019</span>
                        </div>

                        <div>
                            <div class="mb-3">
                                <span class="mr-3"> <span class="icon-clock-o mr-2 text-muted"></span>9:30 AM &mdash; 11:30 AM</span>
                                <span> <span class="icon-room mr-2 text-muted"></span>Ghana Africa</span>
                            </div>
                            <h3><a href="single.html">Ratione Delectus Assumenda Rem Modi Quaerat Laborum</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>