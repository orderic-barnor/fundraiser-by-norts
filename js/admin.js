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

jQuery(document).ready(function($){

    var blocksData = []; // tableau des blocs de la page

    // Ajouter un bloc
    $('#add_block_btn').on('click', function(){
        var selectedBlock = $('#add_block_select').val();
        if(!selectedBlock) return;

        // Ajouter un nouveau bloc avec des valeurs par défaut
        blocksData.push({
            type: selectedBlock,
            title: '',      // valeurs par défaut
            image: null,
            color: '#ffffff'
        });

        renderBlocks(); // fonction pour afficher tous les blocs
    });

    function renderBlocks(){
        var container = $('#blocks_container');
        container.empty();
        blocksData.forEach(function(block, index){
            var html = '<div class="block" data-index="'+index+'">'+
                       '<strong>'+block.type+'</strong> '+
                       '<button class="edit">Edit</button> '+
                       '<button class="delete">Delete</button>'+
                       '</div>';
            container.append(html);
        });
    }

});
