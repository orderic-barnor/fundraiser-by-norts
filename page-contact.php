<?php
/* Template Name: Nous Contacter (Fundraiser by Norts) */

get_header();
?>
<div class="owl-carousel-wrapper">
    <div class="box-92819">
        <h1 class="text-white mb-3">Nous Contacter</h1>
        <p class="lead text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt ab doloremque a quia laboriosam suscipit, iure illum perspiciatis!</p>
    </div>

    <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row">
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

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea name="" id="" class="form-control" placeholder="Dites nous en quoi nous pouvons vous aider" cols="30"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mr-auto">
                            <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5 rounded-0"
                                value="Envoyer">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 ml-auto">
                <div class="bg-white p-3 p-md-5">
                    <h3 class="text-cursive mb-4">Informations</h3>
                    <ul class="list-unstyled footer-link">
                        <li class="d-block mb-3">
                            <span class="d-block text-muted small text-uppercase font-weight-bold">Addresse:</span>
                            <span>34 Street Name, City Name Here, Bénin</span>
                        </li>
                        <li class="d-block mb-3"><span
                                class="d-block text-muted small text-uppercase font-weight-bold">Phone:</span><span>+229 01 000 000 00</span></li>
                        <li class="d-block mb-3"><span
                                class="d-block text-muted small text-uppercase font-weight-bold">Email:</span><span>info@ina-africa.net</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
