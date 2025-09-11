<?php

/**
 * Template Name: Single Event
 * Description: Affiche un événement avec ses détails
 */

get_header();

the_ID();
// Champs personnalisés (ACF ou custom)
$date_event   = get_field('date_event'); // ex: 2025-09-20
$lieu_event   = get_field('lieu_event'); // ex: Cotonou
$prix_event   = get_field('prix_event'); // ex: 5000 CFA
$heure_event  = get_field('heure_event'); // ex: 19h00
$organisateur = get_field('organisateur');

$image = get_template_directory_uri() . '/images/hero_2.jpg';
if (get_the_post_thumbnail_url()) {
    $image = get_the_post_thumbnail_url();
}

$author_id = $post->post_author; // récupère l’ID de l’auteur
$author_display = get_the_author_meta('display_name', $author_id);
$excerpt = get_the_excerpt();
?>
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay event-hero" style="background-image: url('<?php echo $image; ?>')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <?php if ($excerpt) : ?>
                        <h1 class="mb-4 text-cursive h1" data-aos="fade-up" data-aos-delay="100"><?php the_title(); ?></h1>
                    <?php endif; ?>
                    <span class="d-block mb-3 text-white" data-aos="fade-up">
                        <span class="mx-1 text-primary"><?php echo get_the_date('d M Y'); ?></span>
                        <?php 
                            if (get_field('event_start_time', $post_id) && get_field('event_end_time', $post_id)) {
                                echo ' &#124; ' . '<span class="mx-1 text-primary">' . get_field('event_start_time', $post_id) . ' &mdash; ' . get_field('event_end_time', $post_id) . '</span>';
                            }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="event-container container ">
    <div class="event-content">
        <?php the_content(); ?>
    </div>
</div>

<div class="event-meta d-flex justify-content-between container pt-3 border-top border-primary" style="overflow: hidden;">
    <div class="tag">
        <?php
            $event_tags = get_the_tags();
            foreach ($event_tags as $key => $tag) {
                echo '<a href="#">#' . $tag->name . '</a>';
            }
        ?>
        
    </div>
    <div class="share">
        <span>Share:</span>
        <a class="d-inline-block text-center ml-1" href="#"><i class="icon-facebook"></i></a>
        <a class="d-inline-block text-center ml-1" href="#"><i class="icon-twitter"></i></a>
        <a class="d-inline-block text-center ml-1" href="#"><i class="icon-google-plus"></i></a>
        <a class="d-inline-block text-center ml-1" href="#"><i class="icon-instagram"></i></a>
    </div>
</div>
<?php

// endwhile; endif;
get_footer(); ?>