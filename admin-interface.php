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

    <div  id="dashboard-theme" class="d-flex flex-column flex-md-row px-3 py-5">

        <!-- Sidebar (collapsible on mobile) -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sidebar p-3">
            <a class="navbar-brand d-md-none" href="#">Fundraiser by Norts</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse h-100" id="sidebarMenu">
                <div class="nav flex-column nav-pills p-3 h-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-global-tab" data-toggle="pill" href="#v-pills-global" role="tab" aria-controls="v-pills-global" aria-selected="true">Paramètres Généraux</a>
                    <a class="nav-link" id="v-pills-homepage-tab" data-toggle="pill" href="#v-pills-homepage" role="tab" aria-controls="v-pills-homepage" aria-selected="true">Page d'accueil</a>
                    <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a> -->
                </div>
            </div>
        </nav>

        <div class="tab-content flex-grow-1 p-1 p-md-5" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-global" role="tabpanel" aria-labelledby="v-pills-global-tab">
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
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-brands fa-twitter"></i></div>
                                </div>
                                <input type="text" id="twitter_lnk" value="<?php echo get_option("ong_twitter_lnk"); ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Twitter">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-brands fa-instagram"></i></div>
                                </div>
                                <input type="text" id="instagram_lnk" value="<?php echo get_option("ong_instagram_lnk"); ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Instagram">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 py-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-brands fa-linkedin"></i></div>
                                </div>
                                <input type="text" id="linkedin_lnk" value="<?php echo get_option("ong_linkedin_lnk"); ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Lien Linkedin">
                            </div>
                        </div>
                    </div>
                </form>

                <button id="save_params" class="button button-primary">Enregistrer</button>

            </div>
            <div class="tab-pane fade" id="v-pills-homepage" role="tabpanel" aria-labelledby="v-pills-homepage-tab">
                <h1 class="mb-4">Page d'accueil</h1>
                <div id="home_page_form" class="mb-4">
                    <div>
                        <h3 class="mt-3 mb-2">Nos partenaires</h3>
                        <!-- Formulaire d'ajout / modification -->
                        <div id="partner-form" class="row mx-0 p-3 align-content-center border">
                            <div class="col-12 col-md-6 col-xl-3 mb-2 mb-md-0 d-flex">
                                <div class="file-preview d-none"></div>
                                <input type="file" class="admin-custom-file-input" id="partner_logo" name="partner_logo" accept="image/*" placeholder="Logo">
                            </div>
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <input name="partner_name" id="partner_name" type="text" class="form-control" placeholder="Nom du partenaire">
                            </div>

                            <div class="col-12 col-xl-3 pt-3 pt-xl-0 mb-2 mb-md-0 d-flex flex-column flex-md-row justify-content-center align-items-center">
                                <div class="col px-1">
                                    <button class="w-100 mb-1 mb-md-0" type="button" id="partner-form-add">Enregistrer</button>
                                </div>
                                <div class="col px-1">
                                    <button class="w-100" type="button" id="partner-form-reset">Annuler</button>
                                </div>
                            </div>
                            <input type="hidden" name="partner_id" id="partner_id" value="">
                        </div>

                        <!-- Liste des partenaires -->
                        <table id="partners-list" class="d-none d-md-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Les partenaires seront injectés ici via JS -->
                            </tbody>
                        </table>

                        <div id="partners-list-mobile" class="d-md-none">
                            <h3 class="mt-3 mb-2">Liste des partenaires</h3>
                            <div id="partners-list-mobile-container" class="row">

                            </div>
                        </div>
                    </div>

                    <!-- <div class="row ">
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">

                                    <input type="file" class="admin-custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">

                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div> -->
                </div>

                <!-- <button id="save_frontpage_params" class="button button-primary">Enregistrer</button> -->
            </div>
            <!-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> -->
        </div>

    </div>

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
        "ong_twitter_lnk" => "ong_twitter_lnk",
        "ong_instagram_lnk" => "ong_instagram_lnk",
        "ong_linkedin_lnk" => "ong_linkedin_lnk",
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
