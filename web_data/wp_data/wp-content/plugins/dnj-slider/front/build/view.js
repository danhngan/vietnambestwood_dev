(()=>{let e=1;(function(l){let s,t=document.getElementsByClassName("mySlides"),a=document.getElementsByClassName("dot");for(l>t.length&&(e=1),l<1&&(e=t.length),s=0;s<t.length;s++)t[s].style.display="none";for(s=0;s<a.length;s++)a[s].className=a[s].className.replace(" active","");t[e-1].style.display="block",a[e-1].className+=" active"})(e),jQuery("mySlides")})();