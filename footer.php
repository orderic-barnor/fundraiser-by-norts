<?php if (get_field("newsletter_text_descriptif") && get_field("newsletter_button_text")) : ?>
    <div class="site-section bg-primary">
        <div class="container" style="background-color: #026002;">
            <div class="d-md-flex cta-20101 align-self-center p-4">
                <div class="">
                    <h2 class="text-cursive text-white"><?php echo get_field("newsletter_text_descriptif") ?></h2>
                </div>
                <div class="ml-auto"><a href="<?php echo get_field("newsletter_button_link") || "#"; ?>" class="btn bg-white text-primary"><?php echo get_field("newsletter_button_text"); ?></a></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<footer class="site-footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <?php if (get_option("ong_about_title") && get_option("ong_about_description")) : ?>
                        <div class="col-md-7">
                            <h2 class="footer-heading mb-4"><?php echo get_option("ong_about_title") ?></h2>
                            <p><?php echo get_option("ong_about_description") ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-4 ml-auto">
                        <h2 class="footer-heading mb-4">Plan de site</h2>
                        <?php
                        $args_sec = array(
                            'theme_location'  => 'footer',
                            'container'       => false,
                            'menu_class'      => 'site-menu main-menu js-clone-nav pl-0 d-none d-lg-block mb-0',
                        );

                        wp_nav_menu($args_sec);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto">

                <div class="mb-5">
                    <h2 class="footer-heading mb-4">Suivez nos activités</h2>
                    <form action="#" method="post" class="footer-suscribe-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control rounded-0 border-secondary text-white bg-transparent" placeholder="Votre Email" aria-label="Votre Email" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary text-white" type="button" id="button-addon2">Souscrire</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if (get_option("ong_facebook_lnk") || get_option("ong_tiktok_lnk") || get_field("share_instagram") || get_field("share_linkedin")) : ?>
                    <h2 class="footer-heading mb-4">Suivez nous</h2>
                    <?php if (get_option("ong_facebook_lnk")) : ?>
                        <a href="#about-section" class="smoothscroll pl-0 pr-3"><i class="fa-brands fa-facebook"></i></a>
                    <?php endif; ?>
                    <?php if (get_option("ong_tiktok_lnk")) : ?>
                        <a href="#" class="pl-3 pr-3"><i class="fa-brands fa-tiktok"></i></a>
                    <?php endif; ?>
                    <?php if (get_option("ong_instagram_lnk")) : ?>
                        <a href="#about-section" class="smoothscroll pl-0 pr-3"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (get_option("ong_linkedin_lnk")) : ?>
                        <a href="#" class="pl-3 pr-3"><i class="fa-brands fa-linkedin"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="pt-5">
                    <p>
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> Tous droits réservé | INA-AFRICA
                    </p>
                </div>
            </div>

        </div>
    </div>
</footer>
</div> <!-- end site-wrap -->

<?php wp_footer(); ?>
</body>

</html>