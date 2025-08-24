<div class="site-section bg-primary">
    <div class="container" style="background-color: #026002;">
        <div class="d-md-flex cta-20101 align-self-center p-4">
            <div class="">
                <h2 class="text-cursive text-white">Vous pouvez nous accompagner dans nos actions.</h2>
            </div>
            <div class="ml-auto"><a href="#" class="btn bg-white text-primary">Faites un don</a></div>
        </div>
    </div>
</div>

<footer class="site-footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="footer-heading mb-4">A Propos de Nous</h2>
                        <p>
                            Nous œuvrons pour l’autonomisation des femmes, l’insertion des jeunes et la valorisation du patrimoine culturel africain, tout en protégeant l’environnement et en promouvant la santé et le bien-être des populations. Des actions concrètes pour un impact durable sur les communautés.
                        </p>

                    </div>
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
                </div>


                <h2 class="footer-heading mb-4">Suivez nous</h2>
                <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </form>
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