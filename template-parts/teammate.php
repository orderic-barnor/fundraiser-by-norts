<?php 
$post_id = get_the_ID();

if (get_field("teammate_role")) : ?>
<div class="col-lg-4 col-md-6 mb-5">
    <div class="post-entry-1 h-100 bg-white text-center">
        <a href="#" class="d-inline-block" style="width: 15rem;">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', ['class' => ' teammate']); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/person.png" alt="Image" class=" teammate">
            <?php endif; ?>
        </a>
        <div class="post-entry-1-contents">
            <span class="meta"><?php echo get_field("teammate_role", $post_id); ?></span>
            <h2><?php echo get_field("teammate_name", $post_id) ?? the_title(); ?></h2>
            <?php if (get_field("teammate_short_description", $post_id)) : ?>
                <p><?php echo get_field("teammate_short_description", $post_id); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>