<?php
function fundraiser_enqueue_scripts()
{
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

    wp_enqueue_style('fontawesome-style', get_stylesheet_uri() . "/inc/fontawesome/css/all.min.css");

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

    wp_enqueue_script('fontawesome-main', get_template_directory_uri() . '/inc/fontawesome/js/all.min.js', array('jquery'), null, true);

    wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array('jquery'), null, true);
    wp_localize_script('infinite-scroll', 'ajaxurl', array(
        'url' => admin_url('admin-ajax.php')
    ));

    // Enregistre ton script JS
    wp_enqueue_script('fundraiser-script', get_template_directory_uri() . '/js/admin.js', ['jquery'], null, true);

    wp_localize_script('fundraiser-script', 'fundraiser_norts_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('save_general_params')
    ]);
}
add_action('wp_enqueue_scripts', 'fundraiser_enqueue_scripts');

add_action('admin_enqueue_scripts', 'fundraiser_enqueue_scripts');

if (! function_exists('fa_custom_setup_kit') ) {
  function fa_custom_setup_kit($kit_url = '') {
    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $kit_url ) {
          wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
        }
      );
    }
  }
}

// to manage "image mis en avant"
add_theme_support('post-thumbnails');

require_once "inc/menus-functions.php";
require_once "admin-interface.php";

// add_menu_page('Fundraiser Options', 'Fundraiser by Norts', 'manage_options', 'fundraiser-options', 'fundraiser_options_page', '', 21);

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
function mon_theme_setup()
{
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

function fundraiser_register_cpt()
{
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
        'supports' => array('title', 'editor', 'show_in_rest', 'author', 'excerpt', 'comments', 'thumbnail', 'revisions', 'page-attributes'),
        'taxonomies'    => array('post_tag'),
    ));

    $teammate_labels = array(
        'name' => 'Equipier', // __('Events')
        'all_items' => 'Tous les équipiers',  // affiché dans le sous menu
        'singular_name' => 'Équipier', // __('Teammate')
        'add_new_item' => 'Ajouter un nouvel équipier', // __('Add new teammate')
        'edit_item' => "Modifier l'équipier", // __('Update the teammate')
        'menu_name' => 'Equipe',
    );
    register_post_type('teammate', array(
        'labels' => $teammate_labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 22,
        'supports' => array('title', 'editor', 'show_in_rest', 'author', 'excerpt', 'comments', 'thumbnail', 'revisions', 'page-attributes'),
    ));
}
add_action('init', 'fundraiser_register_cpt');

function load_more_posts()
{
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



// function update_donation_form_id($form_id)
// {
// var_dump(get_current_user_id());
// wp_update_post(array(
//     'ID' => $form_id,
//     'post_author' =>  get_current_user_id()
// ));

// return $form_id;

//      $current_user_id = get_current_user_id();
//     if ($current_user_id) {
//         $form_data['post_author'] = $current_user_id;
//     }
//     return $form_data;
// }
// add_action('give_pre_insert_form', 'update_donation_form_id');

/**
 * Assigne l'auteur courant aux forms GiveWP créés sans auteur (post_author = 0).
 * S'exécute après la sauvegarde (save_post) et évite les boucles infinies.
 */
add_action('save_post', 'my_assign_give_form_author_on_save', 10, 3);
function my_assign_give_form_author_on_save($post_id, $post, $update)
{

    // protections basiques
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (! isset($post->post_type) || $post->post_type !== 'give_forms') return; // cible GiveWP

    // si l'auteur est déjà défini, on sort
    if ((int) $post->post_author !== 0) return;

    // récupère l'utilisateur connecté (peut être 0 si pas connecté)
    $current_user_id = get_current_user_id();

    // fallback : si personne de connecté, définir un auteur par défaut (ex: admin 1)
    if ($current_user_id <= 0) {
        $default = (int) get_option('default_give_form_author', 1); // tu peux changer 1
        // sécurité : vérifie que l'ID existe
        if (get_userdata($default)) {
            $current_user_id = $default;
        } else {
            return; // rien à faire si pas d'auteur valide
        }
    }

    // évite boucle: retire l'action avant wp_update_post
    remove_action('save_post', 'my_assign_give_form_author_on_save', 10);

    wp_update_post(array(
        'ID' => $post_id,
        'post_author' => $current_user_id,
    ));

    // ré-ajoute l'action
    add_action('save_post', 'my_assign_give_form_author_on_save', 10, 3);
}

add_action('save_post', function ($post_id, $post, $update) {
    if ($post->post_type !== 'give_forms') return;
    error_log("SAVE_POST give_forms id={$post_id} author={$post->post_author} current_user=" . get_current_user_id());
}, 1, 3);


// to manage comments
function my_theme_display_comments($comments, $depth = 1, $max_depth = 3)
{
    foreach ($comments as $comment) {
        ?>
        <li class="comment">
            <div class="vcard bio">
                <img src="<?php echo get_avatar_url($comment, array(40)); ?>" alt="">
            </div>
            <div class="comment-body">
                <h3><?php echo $comment->comment_author; ?></h3>
                <div class="meta"><?php echo wp_date('d M Y à H:i', strtotime($comment->comment_date)); ?></div>
                <div class="comment-content">
                    <?php echo apply_filters('comment_text', $comment->comment_content); ?>
                </div>

                <div class="comment-reply">
                    <?php
                    echo get_comment_reply_link(array(
                        'reply_text' => 'Répondre',
                        'depth'      => $depth,
                        'max_depth'  => $max_depth,
                    ), $comment->comment_ID, $comment->comment_post_ID);
                    ?>
                </div>
            </div>

            <?php
            $children = get_comments(array(
                'parent'    => $comment->comment_ID,
                'post_id'   => $comment->comment_post_ID,
                'status'    => 'approve',
                'orderby'   => 'comment_date_gmt',
                'order'     => 'ASC',
            ));

            if (!empty($children) && $depth < $max_depth) { ?>
                <ul class="children">
                    <?php
                    my_theme_display_comments($children, $depth + 1, $max_depth);
                    ?>
                </ul>
            <?php } ?>
        </li>
        <?php 
    }
}


function enqueue_comment_reply_script()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_comment_reply_script');


// add_action('pre_comment_on_post', function() {
//     echo '<pre>';
//     var_dump($_POST);
//     echo '</pre>';
//     exit;
// });


if( function_exists('acf_add_options_page') ) {
    acf_add_options_page([
        'page_title' => 'Paramètres du site',
        'menu_title' => 'Paramètres',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ]);
}