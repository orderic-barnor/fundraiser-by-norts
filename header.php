<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap" id="home-section">
        <!-- Top bar + menu -->
        <!-- copie du header de ton index.html ici -->
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <div class="bg-primary py-3 top-bar shadow d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-md-left pl-0">
                        <?php
                        $args_sec = array(
                            'theme_location'  => 'secondary',
                            'container'       => "nav",
                            'container_class' => 'site-navigation text-left ml-auto',
                            'menu_class'      => 'site-menu main-menu js-clone-nav pl-0 d-none d-lg-block mb-0',
                        );

                        wp_nav_menu($args_sec);
                        ?>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="#" class="p-3"><span class="icon-twitter"></span></a>
                        <a href="#" class="p-3"><span class="icon-facebook"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <header class="site-navbar site-navbar-target bg-secondary shadow" role="banner">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="site-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                        <?php endif; ?>
                    </div>

                    <?php
                    $args = array(
                        'theme_location'  => 'primary',
                        'container'       => "nav",
                        'container_class' => 'site-navigation text-left ml-auto',
                        'menu_class'      => 'site-menu main-menu js-clone-nav ml-auto d-none d-lg-block',
                    );

                    wp_nav_menu($args);
                    ?>

                    <div class="ml-auto toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-white"><span class="icon-menu h3 text-white"></span></a></div>
                </div>
            </div>

        </header>