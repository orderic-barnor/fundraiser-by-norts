<?php
/* Template Name: Evenements (Fundraiser by Norts) */

get_header();
?>

<div class="owl-carousel-wrapper">
    <div class="box-92819">
        <h1 class="text-white mb-3">Nos Évènements</h1>
        <p class="lead text-white">La liste des differents événements que nous organisons ou auxquels nous participons.</p>
    </div>

    <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>

<div class="site-section">
    <div class="container">
        <div class="heading-20219 mb-5">
            <h2 class="title text-cursive">Restés informés</h2>
        </div>


        <div class="row">
            <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'paged'		=> $paged,
                'post_type' => 'event'
            );
            $the_query = new WP_Query($args);

            $iterable_expression = [];
            ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <?php get_template_part('template-parts/event', 'event'); ?>
            <?php endwhile; ?>
            
            <div class="d-flex justify-content-center w-100">
                <button id="load-more" class="btn btn-primary py-3 px-4 rounded-0" data-page="1">Afficher plus</button>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
