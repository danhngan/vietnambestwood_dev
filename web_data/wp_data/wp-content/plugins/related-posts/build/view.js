(()=>{"use strict";var t;jQuery.post({url:related_posts_ajax_obj.ajax_url,data:{_ajax_nonce:related_posts_ajax_obj.nonce,action:"request_related_posts",post_id:function(){let t="0";return document.body.classList.forEach((e=>{e.startsWith("postid")&&(t=e.split("-")[1])})),t}(),blocks_ids:function(t){let e=[];for(let s=0;s<t.length;s++)e.push(t[s].getAttribute("blid"));return e}((t=document.getElementsByClassName("related-posts"),t.length>0?t:null))},success:function(t){console.log("The server responded: ",typeof t,t),function(t){for(let e=0;e<t.length;e++);}(t)}})})();