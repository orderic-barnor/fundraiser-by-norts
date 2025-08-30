<?php
$post_id = get_the_ID();

// TODO: Penser à mettre en place un acf pour gerer les images par défaut
// $post_url = get_template_directory_uri() . '/images/our-events.jpg';
// if (has_post_thumbnail()) {
//     $post_url = get_the_post_thumbnail_url($post_id, 'full');
// }

$tags = get_the_terms(get_the_ID(), 'post_tag');
?>
<div class="col-md-6">
    <div class="event-29191 mb-5">
        <a href="<?php the_permalink(); ?>" class="d-block mb-3">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/our-news.jpg" alt="Image" class="img-fluid default-thumbnail">
            <?php endif; ?>
        </a>

        <div class="px-3 d-flex align-items-start">
            <div class="bg-primary p-3 d-inline-block text-center rounded mr-4 date">
                <span class="text-white h3 m-0 d-block"><?php echo get_the_date('d'); ?></span>
                <span class="text-white small"><?php echo get_the_date('M Y'); ?></span>
            </div>

            <div>
                <div class="mb-2">
                    <?php if ($tags) { ?>
                        <span class="mr-3">
                            <span class="icon-bookmark mr-2 text-muted"></span>

                            <?php
                            foreach ($tags as $tag) {
                                echo "<a href='#' class='mr-2'>" . esc_html($tag->name) . '</a>';
                            } ?>
                        </span>
                    <?php } ?>
                    <span> <span class="icon-person mr-2 text-muted"></span><?php the_author(); ?></span>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>


        </div>
    </div>
</div>