export function getCurrentPostID() {
    return jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'get_related_posts',
            // Add any other necessary data here
        },
        success: function (response) {
            // Process the retrieved posts data (response)
            console.log('test ajax res', response);
            // return response
            // Display the posts on your page using JavaScript DOM manipulation
        }
    });
}