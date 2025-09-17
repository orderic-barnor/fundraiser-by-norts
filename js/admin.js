jQuery(document).ready(function ($) {

    var blocksData = [];

    $('#page_select').on('change', function () {
        var pageID = $(this).val();
        if (!pageID) return;

        // Charger les blocs existants via AJAX
        $.post(ajaxurl, {
            action: 'get_page_blocks',
            page_id: pageID
        }, function (data) {
            blocksData = data;
            renderBlocks();
        });
    });

    function renderBlocks() {
        var container = $('#blocks_container');
        container.empty();
        blocksData.forEach(function (block, index) {
            var html = '<div class="block" data-index="' + index + '">' +
                '<strong>' + block.type + '</strong>' +
                ' <button class="edit">Edit</button>' +
                ' <button class="delete">Delete</button>' +
                '</div>';
            container.append(html);
        });

        // Ici tu peux ajouter jQuery UI sortable pour drag & drop
        container.sortable({
            update: function (event, ui) {
                // réorganiser blocksData selon le nouvel ordre
            }
        });
    }

    $('#save_blocks').on('click', function () {
        var pageID = $('#page_select').val();
        $.post(ajaxurl, {
            action: 'save_page_blocks',
            page_id: pageID,
            blocks: JSON.stringify(blocksData)
        }, function (resp) {
            alert('Blocs enregistrés !');
        });
    });
});

jQuery(document).ready(function ($) {
    $('#save_params').on('click', function (e) {
        e.preventDefault();

        // Récupérer les valeurs
        let data = {
            action: 'save_general_params',
            ong_facebook_lnk: $('#facebook_lnk').val(),
            ong_tiktok_lnk: $('#tiktok_lnk').val(),
            ong_about_title: $('#ong_about_title').val(),
            ong_about_description: $('#ong_about_description').val(),
            footer_cta_btn_label: $('#footer_cta_btn_label').val(),
            footer_cta_btn_link: $('#footer_cta_btn_link').val(),
            footer_cta_btn_description: $('#footer_cta_btn_description').val(),
            _ajax_nonce: fundraiser_norts_ajax.nonce
        };

        // Appel AJAX
        $.post(fundraiser_norts_ajax.ajax_url, data, function (response) {
            if (response.success) {
                alert(response.data.message || 'Paramètres enregistrés ✅');
            } else {
                alert(response.data.message || 'Erreur lors de l’enregistrement ❌');
            }
        });
    });
});

jQuery(document).ready(function ($) {
    $('#footer_cta_btn_link').select2({
        ajax: {
            url: fundraiser_norts_ajax.ajax_url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    action: 'ong_search_posts',
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        placeholder: 'Lien du bouton',
        minimumInputLength: 2
    });
});

jQuery(document).ready(function ($) {
    var frame;
    $('#fbn-add-gallery').on('click', function (e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Sélectionner des images',
            button: {
                text: 'Utiliser ces images'
            },
            multiple: true
        });

        frame.on('select', function () {
            var attachments = frame.state().get('selection').toJSON();
            var ids = attachments.map(function (att) {
                return att.id;
            });
            var preview = '';

            ids.forEach(function (id) {
                preview += '<li class="col-2" data-id="' + id + '"><img src="' + attachments.find(a => a.id === id).sizes.thumbnail.url + '"></li>';
            });

            $('#fbn-gallery-container ul').html(preview);
            $('#fbn_gallery_ids').val(ids.join(','));
        });

        frame.open();
    });
});