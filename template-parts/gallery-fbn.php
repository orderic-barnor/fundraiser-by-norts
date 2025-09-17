<?php 
$gallery_ids = get_post_meta(get_the_ID(), '_fbn_gallery_ids', true);

// gallery section
$images = get_attached_media('image', get_the_ID());

if ($gallery_ids) {
    $ids = explode(',', $gallery_ids);
    $total_images = count($ids);
?>
    <div class="row">
        <div class="gallery-fbn-container py-5 my-5 container ">
            <h2 class="text-cursive text-center mb-3">Gallerie</h2>
            <div class="top">
                <ul class="gallery-fbn px-0 ">
                    <?php foreach ($ids as $id) { ?>
                        <li style="width:<?php echo (100 / $total_images); ?>%">
                            <a href="#img_<?php echo $id; ?>">
                                <?php echo wp_get_attachment_image($id, 'full'); ?></a>
                        </li>
                    <?php } ?>
                </ul>
                <?php foreach ($ids as $id) { ?>
                    <a href="#_<?php echo $id; ?>" class="lightbox trans py-4" id="img_<?php echo $id; ?>">
                        <?php echo wp_get_attachment_image($id, 'full'); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }
?>
