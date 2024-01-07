export function getPostID() {
    let postid = '0';
    document.body.classList.forEach((d) => {
        if (d.startsWith('postid')) { postid = d.split('-')[1] }
    })
    return postid
}

export function getRelatedPostsIDs(related_posts_widgets) {
    let related_posts_ids = [];
    for (let i = 0; i < related_posts_widgets.length; i++) {
        related_posts_ids.push(related_posts_widgets[i].getAttribute('blid'))
    }
    return related_posts_ids
}

class RelatedPost {
    postid;
    title;
    url;
    image;
    constructor(postid, title, url, image) {

    }
}


export function handleResponse(response) {
    for (let i = 0; i < response.length; i++) {

    }
}