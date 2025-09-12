<?php
/* Template Name: Nous Rejoindre (Fundraiser by Norts) */

get_header();
?>

<div class="owl-carousel-wrapper">
  <div class="box-92819">
    <h1 class="text-white mb-3"><?php echo get_the_title(); ?></h1>
    <?php if (get_field("joinus_description")) : ?>
      <p class="lead text-white"><?php echo get_field("joinus_description")?></p>
    <?php endif; ?>
  </div>

  <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5">
                <?php echo do_shortcode(get_field("joinus_form_shortcode")); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();