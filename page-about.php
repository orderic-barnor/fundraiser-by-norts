<?php
/* Template Name: À propos (Fundraiser by Norts) */

get_header();
?>

<div class="owl-carousel-wrapper">
  <div class="box-92819">
    <h1 class="text-white mb-3">A Propos de Nous<?php echo get_field("smart_about_title"); ?></h1>
    <p class="lead text-white">Nous œuvrons pour l’autonomisation des femmes, l’insertion des jeunes et la valorisation du patrimoine culturel africain, tout en protégeant l’environnement et en promouvant la santé et le bien-être des populations. Des actions concrètes pour un impact durable sur les communautés.<?php echo get_field("smart_about_short_description"); ?></p>
  </div>

  <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>

<?php if (get_field("about_1_title") && get_field("about_1_description") && get_field("about_1_image")) : ?>
  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo get_field("about_1_image"); ?>" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-5 ml-auto">
          <h3 class="text-cursive mb-4"><?php echo get_field("about_1_title") ?></h3>
          <p><?php echo get_field("about_1_description") ?></p>
          <?php if (get_field("about_1_btn_text")) : ?>
            <p><a href="<?php echo get_field("about_1_btn_link") || "#"; ?>" class="btn btn-primary rounded-0 px-4"><?php echo get_field("about_1_btn_text"); ?></a></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php
$team_args = array(
  'post_type' => 'teammate',
);

$team = new WP_Query($team_args);
?>
<?php if ($team->have_posts()) : ?>
  <div class="site-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h2 class="text-cursive">Notre Equipe</h2>
        </div>
      </div>
      <div class="row justify-content-around">
        <?php while ($team->have_posts()) : $team->the_post(); ?>
          <?php setup_postdata($team); ?>
          <?php get_template_part('template-parts/teammate', 'teammate'); ?>
          <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>


<?php
$args = array(
    'post_type'      => 'give_forms',
    'posts_per_page' => 3, // toutes les campagnes
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$campaigns = new WP_Query($args);

if ($campaigns->have_posts()) : ?>
    <!-- Section causes (exemple avec articles WP) -->
    <div class="site-section">
        <div class="container">
            <div class="row mb-5 align-items-st">
                <div class="col-md-4">
                    <div class="heading-20219">
                        <h2 class="title text-cursive">Nos dernières causes</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <p>Nos dernières causes à soutenir</p>
                </div>
            </div>

            <div class="row">
                <?php
                $campaigns = $campaigns->posts;

                foreach ($campaigns as $campaign) {
                    $id       = $campaign->ID;
                    $title    = get_the_title($id);
                    $excerpt  = get_the_excerpt($id); // vide => falsey
                    $link     = get_permalink($id);
                    $image_url = get_template_directory_uri() . "/images/default_cause.jpg";


                    $author_id = get_post_field('post_author', $id);
                    $avatar_url = get_avatar_url($author_id);
                    $author_name = get_the_author_meta('display_name', $author_id) ? get_the_author_meta('display_name', $author_id) : get_bloginfo('name');

                    // var_dump(get_post($id));

                    global $wpdb;
                    $table_name = $wpdb->prefix . 'give_campaigns';
                    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE form_id = " . $id);
                    $campaign_meta = !empty($results) ? $results[0] : null;

                    if ($campaign_meta && !empty($campaign_meta->campaign_image)) {
                        $image_url = $campaign_meta->campaign_image;
                    }

                    // var_dump($avatar_url);

                    // GiveWP
                    $goal     = (float) $campaign_meta->$campaign_goal;
                    $donated  = (float) give_get_form_earnings_stats($id);
                    $formatted_goal = give_currency_filter(give_format_amount($goal));
                    // var_dump($formatted_goal);
                    $progress = $goal > 0 ? min(100, round(($donated / $goal) * 100)) : 0;
                ?>
                    <div class="col-md-4">
                        <div class="cause shadow-sm">
                            <a href="<?= $link ?>" class="cause-link d-block">
                                <img src="<?php echo $image_url ?>" alt="Image" class="img-fluid default-thumbnail">
                                <div class="custom-progress-wrap">
                                    <span class="caption"><?php echo $progress; ?>% completé</span>
                                    <div class="custom-progress-inner">
                                        <div class="custom-progress bg-danger" style="width: <?php echo $progress; ?>%;"></div>
                                    </div>
                                </div>
                            </a>

                            <div class="px-3 pt-3 border-top-0 border border shadow-sm">
                                <span class="badge-danger py-1 small px-2 rounded mb-3 d-inline-block">School</span>
                                <h3 class="mb-4" style="min-height: 4rem;"><a href="<?= $link ?>"><?php echo $title; ?></a></h3>
                                <div class="border-top border-light border-bottom py-2 d-flex">
                                    <div>Donations</div>
                                    <div class="ml-auto"><strong class="text-primary"><?php echo $formatted_goal; ?></strong></div>
                                </div>

                                <!-- <div class="py-4">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php // echo $avatar_url ?>" alt="Image" class="rounded-circle mr-3" width="50">
                                        <div class=""><?php // echo $author_name; ?></div>
                                    </div>
                                </div> -->
                            </div>

                        </div>
                    </div>
                <?php
                    // 
                }
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php get_footer();
