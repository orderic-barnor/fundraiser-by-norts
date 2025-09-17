<?php get_header(); ?>

<!-- Hero section -->
<?php
$title = get_field('slide_1_title');
$subtitle = get_field('slide_1_subtitle');
$button_text = get_field('slide_1_button_text');
$button_link = get_field('slide_1_button_link');
?>
<div class="owl-carousel-wrapper">
    <?php if (isset($subtitle) || isset($button_text) || isset($button_link)): ?>
        <div class="box-92819">
            <?php if ($title): ?>
                <h1 class="text-white mb-3"><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ($subtitle): ?>
                <h1 class="text-white mb-3"><?php echo $subtitle; ?></h1>
            <?php endif; ?>
            <?php if ($button_text): ?>
                <p><a href="<?php echo $button_link ?: "#"; ?>" class="btn btn-primary py-3 px-4 rounded-0"><?php echo $button_text; ?></a></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="owl-carousel owl-1 ">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <?php $image = get_field('slide_' . $i . '_image'); ?>

            <?php if ($image): ?>
                <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo esc_url($image); ?>')"></div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

</div>


<!-- Section secteurs d'interventions -->
<div class="container">
    <div class="feature-29192-wrap d-md-flex" style="margin-top: -20px; position: relative; z-index: 2; height: 20rem;">
        <?php
        $class = [
            1 => 'overlay-danger',
            2 => 'overlay-success',
            3 => 'overlay-warning'
        ];
        ?>

        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <?php
            $title = get_field("sector_title_" . $i);
            $subtitle = get_field("sector_subtitle_" . $i);
            $image_url = get_field("sector_image_" . $i);


            $css_style = "background-color: re  d;";
            if ($image_url) {
                $css_style = "background-image: url('" . esc_url($image_url) . "');";
            }
            ?>

            <a href="#" class="feature-29192 <?php echo $class[$i]; ?>" style="<?php echo $css_style; ?>">
                <div class="text">
                    <span class="meta"><?php echo $title; ?></span>
                    <h3 class="text-cursive text-white h1"><?php echo $subtitle; ?></h3>
                </div>
            </a>
        <?php endfor; ?>
    </div>
</div>

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
                        <h2 class="title text-cursive">Les dernières causes</h2>
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
                    $goal     = (float) $campaign_meta->campaign_goal;
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

                                <div class="py-4">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $avatar_url ?>" alt="Image" class="rounded-circle mr-3" width="50">
                                        <div class=""><?php echo $author_name; ?></div>
                                    </div>
                                </div>
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

<?php
$block_container_css = "";
$background_image = get_field("block_background");
if ($background_image) {
    $block_container_css = "background-image: url(" . $background_image . ");";
}

$block_title = get_field("block_title") ?: "";
$block_description = get_field("block_description") ?: "";

$show_subtitles = false;
for ($i = 1; $i <= 4; $i++) {
    if (get_field("subtitle_" . $i)) {
        $show_subtitles = true;
        break;
    }
}


?>
<div class="bg-image overlay site-section mt-5" style="<?php echo $block_container_css; ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <?php if ($block_title || $block_description) : ?>
                    <div class="row mb-5">
                        <div class="col-md-7">
                            <div class="heading-20219">
                                <?php if ($block_title) : ?>
                                    <h2 class="title text-white mb-4 text-cursive"><?php echo $block_title; ?></h2>
                                <?php endif; ?>
                                <?php if ($block_description) : ?>
                                    <p class="text-white"><?php echo $block_description; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($show_subtitles) : ?>
                    <div class="row">
                        <?php
                        $count = 1;
                        for ($i = 1; $i <= 4; $i++) {
                            $subtitle = get_field("subtitle_" . $i);

                            if (!$subtitle) {
                                continue;
                            }

                            $subtitle_description = get_field("subtitle_" . $i . "_description");
                        ?>
                            <div class="col-md-6 mb-5">
                                <div class="feature-29012 d-flex">
                                    <div class="number mr-4"><span><?php echo $count; ?></span></div>
                                    <div>
                                        <h3><?php echo $subtitle; ?></h3>
                                        <p><?php echo $subtitle_description; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php

                            $count++;
                        } ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$event_args = array(
    'post_type' => 'event',
    'posts_per_page' => 2
);

$events = new WP_Query($event_args);
?>

<?php if (get_field("events_section_title") && $events->have_posts()) : ?>
    <div class="site-section">
        <div class="container">
            <div class="heading-20219 mb-5">
                <h2 class="title text-cursive"><?php echo get_field("events_section_title"); ?></h2>
            </div>

            <div class="row">
                <?php while ($events->have_posts()) : $events->the_post(); ?>
                    <?php get_template_part('template-parts/event', 'event'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>