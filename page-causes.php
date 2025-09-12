<?php
/* Template Name: Nos Causes (Fundraiser by Norts) */

get_header();
?>

<div class="owl-carousel-wrapper">
    <div class="box-92819">
        <h1 class="text-white mb-3"><?php the_title();  ?></h1>
        <p class="lead text-white"><?php echo get_field("causes_page_description"); ?></p>
    </div>

    <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>

<div class="site-section">
    <div class="container">

        <?php
        $featured_campaign = get_field("cause_featured") ?: false;
        if ($featured_campaign) {
            $id = $featured_campaign;

            global $wpdb;
            $table_name = $wpdb->prefix . 'give_campaigns';
            $results = $wpdb->get_results("SELECT * FROM $table_name WHERE form_id = " . $featured_campaign);
            $featured_campaign_meta = !empty($results) ? $results[0] : null;

// TODO: penser a ajouter un parametre acf pour choisir la couleur qui gerera les tags et la progression 
            if ($featured_campaign_meta) {
                $image_url = $featured_campaign_meta->campaign_image ?? get_template_directory_uri() . "/images/default_cause.jpg";
                $campaign_description = $featured_campaign_meta->short_desc ?? "";

                $title    = get_the_title($featured_campaign);
                $excerpt  = get_the_excerpt($featured_campaign); // vide => falsey
                $link     = get_permalink($id);

                $goal     = (float) $featured_campaign_meta->$campaign_goal;
                $donated  = (float) give_get_form_earnings_stats($id);
                $formated_goal = give_currency_filter(give_format_amount($goal));
                $progress = $goal > 0 ? min(100, round(($donated / $goal) * 100)) : 0;

                $author_id = get_post_field('post_author', $featured_campaign);
                $avatar_url = get_avatar_url($author_id);
                $author_name = get_the_author_meta('display_name', $author_id) ? get_the_author_meta('display_name', $author_id) : get_bloginfo('name');


                $tags = get_the_terms($id, "give_forms_tag");
        ?>
                <div class="row mb-5 align-items-st">
                    <div class="col-md-5">
                        <div class="heading-20219">
                            <h2 class="title text-cursive mb-4"><?php echo get_field("campaign_featured_block_title"); ?></h2>
                            <?php echo $campaign_description; ?>
                            <p><a href="<?php echo get_field("campaign_cta_btn_link") ?? "#"; ?>" class="btn btn-primary rounded-0 px-4"><?php echo get_field("campaign_cta_btn_text") ?? "Faites un don" ?></a></p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="cause shadow-sm">
                            <a href="#" class="cause-link d-block">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/img_1.jpg" alt="Image" class="img-fluid">
                                <div class="custom-progress-wrap">
                                    <span class="caption"><?php echo $progress; ?> completé</span>
                                    <div class="custom-progress-inner">
                                        <div class="custom-progress bg-danger" style="width: <?php echo $progress; ?>%;"></div>
                                    </div>
                                </div>
                            </a>

                            <div class="px-3 pt-3 border-top-0 border border shadow-sm">
                                <?php if ($tags) : ?>
                                    <?php foreach ($tags as $tag) : ?>
                                        <span class="badge-success py-1 small px-2 rounded mb-3 d-inline-block" style="color: #fff !important;"><?php echo $tag->name; ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <h3 class="mb-4"><a href="#"><?php echo $title; ?></a></h3>
                                <div class="border-top border-light border-bottom py-2 d-flex">
                                    <div>Donations</div>
                                    <div class="ml-auto"><strong class="text-primary"><?php echo $formated_goal; ?></strong></div>
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
                </div>
        <?php
            }
        }
        ?>

        <div class="row">
            <?php
            $args = array(
                'post_type'      => 'give_forms',
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $campaigns = new WP_Query($args);

            if ($campaigns->have_posts()) : ?>


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

                        global $wpdb;
                        $table_name = $wpdb->prefix . 'give_campaigns';
                        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE form_id = " . $id);
                        $campaign_meta = !empty($results) ? $results[0] : null;

                        if ($campaign_meta && !empty($campaign_meta->campaign_image)) {
                            $image_url = $campaign_meta->campaign_image;
                        }

                        $tags = get_the_terms($id, "give_forms_tag");

                        // GiveWP
                        $goal     = (float) $campaign_meta->$campaign_goal;
                        $donated  = (float) give_get_form_earnings_stats($id);
                        $formatted_goal = give_currency_filter(give_format_amount($goal));

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
                                    <?php if ($tags && !is_wp_error($tags)) : ?>
                                        <?php foreach ($tags as $tag) : ?>
                                            <span class="badge-success py-1 small px-2 rounded mb-3 d-inline-block" style="color: #fff !important;"><?php echo $tag->name; ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
            <?php endif; ?>

            <div class="d-flex justify-content-center w-100">
                <button id="load-more" class="btn btn-primary py-3 px-4 rounded-0" data-page="1">Charger plus</button>
            </div>



        </div>
    </div>
</div>


<?php
get_footer();
