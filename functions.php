<?php
function fundraiser_enqueue_scripts() {
    // CSS
    wp_enqueue_style('fundraiser-google-fonts', 'https://fonts.googleapis.com/css?family=Mansalva|Roboto&display=swap');
    wp_enqueue_style('fundraiser-icomoon', get_template_directory_uri() . '/fonts/icomoon/style.css');
    wp_enqueue_style('fundraiser-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fundraiser-animate', get_template_directory_uri() . '/css/animate.min.css');
    wp_enqueue_style('fundraiser-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css');
    wp_enqueue_style('fundraiser-owl', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style('fundraiser-owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
    wp_enqueue_style('fundraiser-flaticon', get_template_directory_uri() . '/fonts/flaticon/font/flaticon.css');
    wp_enqueue_style('fundraiser-aos', get_template_directory_uri() . '/css/aos.css');
    wp_enqueue_style('fundraiser-main', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('fundraiser-style', get_stylesheet_uri());

    // JS
    wp_enqueue_script('jquery');
    wp_enqueue_script('fundraiser-popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-animateNumber', get_template_directory_uri() . '/js/jquery.animateNumber.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), null, true);
    wp_enqueue_script('fundraiser-main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'fundraiser_enqueue_scripts');

// to manage "image mis en avant"
add_theme_support('post-thumbnails');

register_nav_menus(array(
    'primary' => __('Primary Menu', 'fundraiser'),
));

add_menu_page('Fundraiser Options', 'Fundraiser by Norts', 'manage_options', 'fundraiser-options', 'fundraiser_options_page');

function fundraiser_options_page() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields('fundraiser_settings'); ?>
        <?php do_settings_sections('fundraiser_settings'); ?>
        <input type="text" name="fundraiser_hero_button" value="<?php echo get_option('fundraiser_hero_button'); ?>">
        <?php submit_button(); ?>
    </form>
    <?php
}

add_filter( 'excerpt_length', function(){
	return 20;
} );