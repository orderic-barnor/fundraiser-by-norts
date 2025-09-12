jQuery(document).ready(function($){

    var blocksData = [];

    $('#page_select').on('change', function(){
        var pageID = $(this).val();
        if(!pageID) return;

        // Charger les blocs existants via AJAX
        $.post(ajaxurl, { action: 'get_page_blocks', page_id: pageID }, function(data){
            blocksData = data;
            renderBlocks();
        });
    });

    function renderBlocks(){
        var container = $('#blocks_container');
        container.empty();
        blocksData.forEach(function(block, index){
            var html = '<div class="block" data-index="'+index+'">'+
                       '<strong>'+block.type+'</strong>'+
                       ' <button class="edit">Edit</button>'+
                       ' <button class="delete">Delete</button>'+
                       '</div>';
            container.append(html);
        });

        // Ici tu peux ajouter jQuery UI sortable pour drag & drop
        container.sortable({
            update: function(event, ui){
                // réorganiser blocksData selon le nouvel ordre
            }
        });
    }

    $('#save_blocks').on('click', function(){
        var pageID = $('#page_select').val();
        $.post(ajaxurl, {
            action: 'save_page_blocks',
            page_id: pageID,
            blocks: JSON.stringify(blocksData)
        }, function(resp){
            alert('Blocs enregistrés !');
        });
    });
});

jQuery(document).ready(function($) {
    $('#save_params').on('click', function(e) {
        e.preventDefault();

        // Récupérer les valeurs
        let data = {
            action: 'save_general_params',
            facebook_lnk: $('#facebook_lnk').val(),
            tiktok_lnk: $('#tiktok_lnk').val(),
            _ajax_nonce: fundraiser_norts_ajax.nonce // sécurité (tu devras localiser ce nonce côté PHP)
        };

        // Appel AJAX
        $.post(fundraiser_norts_ajax.ajax_url, data, function(response) {
            if (response.success) {
                alert(response.data.message || 'Paramètres enregistrés ✅');
            } else {
                alert(response.data.message || 'Erreur lors de l’enregistrement ❌');
            }
        });
    });
});

