<?php
/* Template Name: Nous Contacter (Fundraiser by Norts) */

get_header();
?>
<div class="owl-carousel-wrapper">
    <div class="box-92819">
        <h1 class="text-white mb-3"><?php echo get_field("contact_page_title")?></h1>
        <p class="lead text-white"><?php echo get_field("contact_page_description")?></p>
    </div>

    <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>


<div class="site-section">
    <div class="container">
        <div class="row">
            <?php
            $only_contact_form = false;
            if (get_field("contact_page_address") || get_field("contact_page_phone") || get_field("contact_page_email")) {
                $only_contact_form = true;
            }
            ?>
            <div class="<?php echo $only_contact_form ? 'col-md-8' : 'col-md-12'; ?> mb-5">
                <?php
                $form_shortcode = get_field("contact_form_shortcode");
                echo do_shortcode($form_shortcode);
                ?>
            </div>
            <?php if ($only_contact_form) : ?>
                <div class="col-lg-4 ml-auto">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-cursive mb-4">Informations</h3>
                        <ul class="list-unstyled footer-link">
                            <?php if (get_field("contact_page_address")) : ?>
                                <li class="d-block mb-3">
                                    <span class="d-block text-muted small text-uppercase font-weight-bold">Addresse:</span>
                                    <span><?php echo get_field("contact_page_address"); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field("contact_page_phone")) : ?>
                                <li class="d-block mb-3">
                                    <span class="d-block text-muted small text-uppercase font-weight-bold">Phone:</span>
                                    <span><?php echo get_field("contact_page_phone"); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field("contact_page_email")) : ?>
                                <li class="d-block mb-3">
                                    <span class="d-block text-muted small text-uppercase font-weight-bold">Email:</span>
                                    <span><?php echo get_field("contact_page_email"); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
