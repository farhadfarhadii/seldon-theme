//https://artisansweb.net/load-wordpress-post-ajax/#:~:text=Load%20WordPress%20Posts%20with%20Ajax%20on%20Load%20More%20Button,below%20code%20in%20the%20functions.

// PUT REMOVED POSTS IDS INTO ARRAY IN HIDDEN FIELD, pass that along
jQuery(function($) {
	var excludePosts = $('#RemovedPosts').val() || '';

	// var page - automatically increments after first load
	// needed for custom publications landing page
	var page = excludePosts ? 1 : 2; 

	var postTypes = $('#PostTypes').val() || 'post';
	var catName = $('#CatName').val() || ''; // relevant on Research LP only

    $('body').on('click', '.loadmore', function() {
    	
    	var button = $(this);
    	button.html('Loading...');
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': research.security,
            'excludePosts': excludePosts,
            'postTypes': postTypes,
            'catName': catName
        };

        $.post(research.ajaxurl, data, function(response) {

            if($.trim(response) != '') {
                page++;
                var firstCol = response.indexOf('col-xs-12');
                var pageNo = 'page_' + page + ' ';
                response = [response.slice(0, firstCol), pageNo, response.slice(firstCol)].join('');
                $('.post-listing').append(response);

                var indices = [];
				var regex = /col-xs-12/gi, result, indices = [];
				while ( (result = regex.exec(response)) ) {
				    indices.push(result.index);
				}

				if (indices.length < 9) { // 9) { // 9 results per page set in optional-functions.php
	                button.hide();
				}

				setTimeout(function () {
		            $('.mh-outer2').matchHeight();
		            $('html, body').animate({
						scrollTop: $('.' + pageNo).offset().top - 30
					}, 1000);
			    	button.html('Load more');

				}, 0)

            } else {
                button.hide();
            }
        });
    });
});