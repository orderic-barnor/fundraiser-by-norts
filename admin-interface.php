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
                <div class="nav flex-column nav-pills p-3 h-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Paramètres Généraux</a>
                    <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a> -->
                </div>
            </div>
        </nav>

        <div class="tab-content flex-grow-1 p-5" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <?php
                /* ?>
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
                    <?php */
                ?>

                <h1 class="mb-4">Paramètres Généraux</h1>

                <form class="mb-4">
                    <h3 class="mt-3 mb-2">CTA Footer</h3>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <input id="footer_cta_btn_label" type="text" value="<?php echo get_option("footer_cta_btn_label"); ?>" class="form-control" placeholder="Label du bouton">
                        </div>
                        <div class="col-lg-6 py-1">
                            <?php
                            $saved = get_option("footer_cta_btn_link");
                            $selected_post = $saved ? get_post($saved) : false;
                            ?>
                            <select id="footer_cta_btn_link" placeholder="lien de la page" style="width: 100%;">
                                <?php if ($selected_post): ?>
                                    <option value="<?php echo $selected_post->ID; ?>" selected="selected">
                                        <?php echo esc_html($selected_post->post_title . ' (' . $selected_post->post_type . ')'); ?>
                                    </option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-6 py-1">
                            <input id="footer_cta_btn_description" type="text" value="<?php echo get_option("footer_cta_btn_description"); ?>" class="form-control" placeholder="Description">
                        </div>
                    </div>

                    <h3 class="mt-3 mb-2">Footer</h3>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <input type="text" id="ong_about_title" value="<?php echo get_option("ong_about_title"); ?>" class="form-control" placeholder="Titre A Propos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <textarea id="ong_about_description" class="w-100" placeholder="Description A Propos"><?php echo get_option("ong_about_description"); ?></textarea>
                        </div>
                    </div>

                    <h3 class="mt-3 mb-2">Réseaux Sociaux</h3>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="color: #0866ff"><i class="fa-brands fa-facebook"></i></div>
                                </div>
                                <input type="text" id="facebook_lnk" value="<?php echo get_option("ong_facebook_lnk"); ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Facebook">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-brands fa-tiktok"></i></div>
                                </div>
                                <input type="text" id="tiktok_lnk" value="<?php echo get_option("ong_tiktok_lnk"); ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Tiktok">
                            </div>
                        </div>
                    </div>
                </form>

                <button id="save_params" class="button button-primary">Enregistrer</button>

            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
        </div>

    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>
<?php
}

add_action('wp_ajax_save_general_params', function () {
    if (! current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Accès refusé']);
    }

    // Liste des champs autorisés
    $fields = [
        'ong_facebook_lnk' => 'ong_facebook_lnk',
        'ong_tiktok_lnk'   => 'ong_tiktok_lnk',
        'ong_about_title' => 'ong_about_title',
        'ong_about_description' => 'ong_about_description',
        "footer_cta_btn_label" => "footer_cta_btn_label",
        "footer_cta_btn_link" => "footer_cta_btn_link",
        "footer_cta_btn_description" => "footer_cta_btn_description"
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
