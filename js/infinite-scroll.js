jQuery(function($){
    $('#load-more').on('click', function(){
        let button = $(this);
        let page = button.data('page');
        let nextPage = page + 1;

        $.ajax({
            url: ajaxurl.url,
            type: 'post',
            data: {
                action: 'load_more_posts',
                page: nextPage
            },
            success: function(data){
                if(data){
                    $('#posts-wrapper').append(data);
                    button.data('page', nextPage);
                } else {
                    button.remove(); // plus de posts
                }
            }
        });
    });
});
