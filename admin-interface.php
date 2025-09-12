<?php

add_action('admin_menu', function () {
    add_menu_page(
        'Fundraiser by Norts',           // Titre de la page
        'Fundraiser by Norts',           // Nom dans le menu
        'manage_options',         // Capability
        'fundraiser_by_norts',        // slug
        'render_page_builder',    // fonction de rendu
        'dashicons-layout',       // icône
        20
    );
});
function render_page_builder()
{
    $pages = get_pages(); // toutes les pages
?>

    <div class="d-flex flex-column flex-md-row px-3 py-5" style="min-height: 90vh;">
        <!-- Sidebar (collapsible on mobile) -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sidebar p-3">
            <a class="navbar-brand d-md-none" href="#">Fundraiser by Norts</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse h-100" id="sidebarMenu">
                <ul class="nav flex-column w-100 h-100">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Paramètres Généraux</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <div class="flex-grow-1 p-4">
            <?php /* ?>
            <h1>Page Builder</h1>
            
            <select id="page_select">
                <option value="">Choisir une page</option>
                <?php foreach ($pages as $page): ?>
                    <option value="<?php echo $page->ID ?>"><?php echo $page->post_title ?></option>
                <?php endforeach; ?>
            </select>

            <select id="add_block_select">
                <option value="">Ajouter un bloc</option>
                <?php
                $blocks = get_available_blocks();
                foreach ($blocks as $key => $label) {
                    echo '<option value="' . esc_attr($key) . '">' . esc_html($label) . '</option>';
                }
                ?>
            </select>
            <button id="add_block_btn">Ajouter</button>

            <div id="blocks_container">
                <!-- Les blocs s'afficheront ici via JS -->
            </div>
            <?php */ ?>

            <h1 class="mb-4">Paramètres Généraux</h1>

            <form class="mb-4">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name">
                    </div>
                </div>

                <h3 class="mt-3 mb-2">Réseaux Sociaux</h3>
                <div class="row">
                    <div class="col-lg-6 py-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="color: #0866ff"><i class="fa-brands fa-facebook"></i></div>
                            </div>
                            <input type="text" id="facebook_lnk" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Facebook">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 py-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-brands fa-tiktok"></i></div>
                            </div>
                            <input type="text" id="tiktok_lnk" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Tiktok">
                        </div>
                    </div>
                </div>
            </form>

            <button id="save_params" class="button button-primary">Enregistrer</button>
        </div>
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>
<?php
}

add_action('wp_ajax_save_general_params', function () {
    if ( ! current_user_can('manage_options') ) {
        wp_send_json_error(['message' => 'Accès refusé']);
    }

    // Liste des champs autorisés
    $fields = [
        'facebook_lnk' => 'ong_facebook_lnk',
        'tiktok_lnk'   => 'ong_tiktok_lnk',
    ];

    foreach ($fields as $post_key => $option_key) {
        if (isset($_POST[$post_key])) {
            update_option($option_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    wp_send_json_success(['message' => 'Paramètres enregistrés']);
});


add_action('wp_ajax_get_page_blocks', function () {
    $page_id = intval($_POST['page_id']);
    $blocks = get_post_meta($page_id, 'my_page_blocks', true);
    if (!$blocks) $blocks = [];
    wp_send_json($blocks);
});

add_action('wp_ajax_save_page_blocks', function () {
    $page_id = intval($_POST['page_id']);
    $blocks = json_decode(stripslashes($_POST['blocks']), true);
    update_post_meta($page_id, 'my_page_blocks', $blocks);
    wp_send_json_success();
});

function get_available_blocks()
{
    return [
        'hero' => 'Hero',
        'features' => 'Features',
        'cta' => 'Call to Action',
        // ajoute d’autres blocs ici
    ];
}
