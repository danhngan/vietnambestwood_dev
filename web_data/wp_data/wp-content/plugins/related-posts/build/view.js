(()=>{"use strict";var e=document.getElementsByClassName("related-posts");if(e.length>0)var t=e[0];else(t=document.createElement("div")).setAttribute("class","related-posts"),document.body.appendChild(t);jQuery.post({url:related_posts_ajax_obj.ajax_url,data:{_ajax_nonce:related_posts_ajax_obj.nonce,action:"request_related_posts",post_id:function(){let e="0";return document.body.classList.forEach((t=>{t.startsWith("postid")&&(e=t.split("-")[1])})),e}()},success:function(e){console.log("The server responded: ",typeof e,e)}});const s=document.createElement("div");s.textContent="this is test",t.appendChild(s)})();