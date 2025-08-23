<?php get_header(); ?>

<!-- Hero section -->
<div class="owl-carousel-wrapper">
  <div class="box-92819">
    <!-- <h1 class="text-white mb-3"><?php // bloginfo('description'); ?></h1> -->
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
                    <?php if ( has_post_thumbnail() ) : ?>
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
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
