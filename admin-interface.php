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
    <div class="wrap">
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

        <button id="save_blocks" class="button button-primary">Enregistrer</button>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>
<?php
}


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
