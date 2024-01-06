import './style-index.module.scss';
import './front_end/base'
import { handleResponse, getRelatedPostsIDs, getPostID } from './front_end/base';

function getRelatedPostsWidgets() {
    var related_posts_widgets = document.getElementsByClassName('related-posts');
    if (related_posts_widgets.length > 0) {
        return related_posts_widgets
    }
    else {
        return null
    }
}


jQuery.post({
    url: related_posts_ajax_obj.ajax_url,
    data: {
        _ajax_nonce: related_posts_ajax_obj.nonce,
        action: 'request_related_posts',
        post_id: getPostID(),
        blocks_ids: getRelatedPostsIDs(getRelatedPostsWidgets())
    },
    success: function (response) {
        console.log('The server responded: ', typeof response, response);
        handleResponse(response);
    }
}
)