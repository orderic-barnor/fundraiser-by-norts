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

    wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array('jquery'), null, true);
    wp_localize_script('infinite-scroll', 'ajaxurl', array(
        'url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'fundraiser_enqueue_scripts');

// to manage "image mis en avant"
add_theme_support('post-thumbnails');

require_once "inc/menus-functions.php";



add_menu_page('Fundraiser Options', 'Fundraiser by Norts', 'manage_options', 'fundraiser-options', 'fundraiser_options_page', '', 21);

function fundraiser_options_page()
{
?>
    <form method="post" action="options.php">
        <?php settings_fields('fundraiser_settings'); ?>
        <?php do_settings_sections('fundraiser_settings'); ?>
        <input type="text" name="fundraiser_hero_button" value="<?php echo get_option('fundraiser_hero_button'); ?>">
        <?php submit_button(); ?>
    </form>
<?php
}

add_filter('excerpt_length', function () {
    return 20;
});

// Configure my theme after setup
function mon_theme_setup() {
    // for logo
    add_theme_support('custom-logo', array(
        'height'      => 300, 
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mon_theme_setup');

// function fundraiser_customize_register($wp_customize) {

//     $template = basename( get_page_template() );

//     var_dump(is_page_template('page-about.php'));






//     $wp_customize->add_section('fundraiser_hero', array(
//         'title' => __('Hero Section', 'fundraiser'),
//         'priority' => 30,
//     ));

//     $wp_customize->add_setting('fundraiser_hero_title', array(
//         'default' => 'Join The Movement To end Child Poverty',
//     ));

//     $wp_customize->add_control('fundraiser_hero_title', array(
//         'label' => __('Hero Title', 'fundraiser'),
//         'section' => 'fundraiser_hero',
//         'type' => 'text',
//     ));
// }
// add_action('customize_register', 'fundraiser_customize_register');

function fundraiser_register_cpt() {
     $labels = array(
        'name' => 'Événements', // __('Events')
        'all_items' => 'Tous les événements',  // affiché dans le sous menu
        'singular_name' => 'Événement', // __('Event')
        'add_new_item' => 'Ajouter un nouvel événement', // __('Add new event')
        'edit_item' => "Modifier l'événement", // __('Update the event')
        'menu_name' => 'Évenements',
    );

    register_post_type('event', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 22, 
        'supports' => array('title', 'editor', 'show_in_rest', 'author', 'excerpt', 'comments','thumbnail','revisions', 'page-attributes'),
        'taxonomies'    => array('post_tag'),
    ));
}
add_action('init', 'fundraiser_register_cpt');

function load_more_posts() {
    $paged = $_POST['page'];

    $query = new WP_Query(array(
        'post_type' => 'event',
        'paged' => $paged,
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <?php get_template_part('template-parts/event', 'event'); ?>
        <?php endwhile;
    endif;
    wp_reset_postdata();

    die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
