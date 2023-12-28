import './style-index.module.scss';

function getPostID() {
    let postid = '0';
    document.body.classList.forEach((d) => {
        if (d.startsWith('postid')) { postid = d.split('-')[1] }
    })
    return postid
}


var related_posts_widgets = document.getElementsByClassName('related-posts');
if (related_posts_widgets.length > 0) {
    var related_posts_widget = related_posts_widgets[0]
}
else {
    var related_posts_widget = document.createElement('div');
    related_posts_widget.setAttribute('class', 'related-posts')
    document.body.appendChild(related_posts_widget)
}
jQuery.post({
    url: related_posts_ajax_obj.ajax_url,
    data: {
        _ajax_nonce: related_posts_ajax_obj.nonce,
        action: 'request_related_posts',
        post_id: getPostID()
    },
    success: function (response) {
        console.log('The server responded: ', typeof response, response);
    }
}
)


const widget = document.createElement('div');
widget.textContent = 'this is test'
related_posts_widget.appendChild(widget)


// document.body.classList.forEach((d)=>{if(d.startsWith('postid')){console.log(d)}})