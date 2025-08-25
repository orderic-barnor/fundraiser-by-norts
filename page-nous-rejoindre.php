<?php
/* Template Name: Nous Rejoindre (Fundraiser by Norts) */

get_header();
?>

<div class="owl-carousel-wrapper">
  <div class="box-92819">
    <h1 class="text-white mb-3">Nous Rejoindre</h1>
    <p class="lead text-white">Devenez membre d'un grand mouvement</p>
  </div>

  <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5">
                <form action="#" method="post">
                    <div class="form-group row">
                        <div class="col-md-6 mb-4 mb-lg-0">
                            <input type="text" class="form-control" placeholder="Prénom">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nom de famille">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    
                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5 rounded-0"
                                value="Envoyer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();