var Renren=Renren||{};Renren.share||(Renren.share=function(){var e=navigator.userAgent.match(/(msie) ([\w.]+)/i),t=location.href.indexOf("#"),n=-1==t?location.href:location.href.substr(0,t),r="",a=function(){var e="http://xnimg.cn/xnapp/share/css/v2/rrshare.css",t=document.createElement("link");t.rel="stylesheet",t.type="text/css",t.href=e,(document.getElementsByTagName("head")[0]||document.body).appendChild(t)},i=function(e){return e.getAttribute("type")||"button"},o={};"undefined"!=typeof imgMinWidth?o.imgMinWidth=imgMinWidth||60:o.imgMinWidth=60,"undefined"!=typeof imgMinHeight?o.imgMinHeight=imgMinHeight||60:o.imgMinHeight=60;var d=function(e,t){if(!e.rendered){e.paramIndex=t;var n=i(e).split("_"),r="icon"==n[0]?"icon":"button",a=n[1]||"small",o="xn_share_"+r+"_"+a,d=['<span class="xn_share_wrapper ',o,'"></span>'];e.innerHTML=d.join(""),e.rendered=!0}},s=function(t){var n=document.createElement("form");n.action=t.url,n.target=t.target,n.method="POST",n.acceptCharset="UTF-8";for(var r in t.params){var a=t.params[r];if(null!==a&&void 0!==a){var i=document.createElement("textarea");i.name=r,i.value=a,n.appendChild(i)}}var o=document.getElementById("renren-root-hidden");o||(o=document.createElement("div"),syl=o.style,syl.positon="absolute",syl.top="-10000px",syl.width=syl.height="0px",o.id="renren-root-hidden",(document.body||document.getElementsByTagName("body")[0]).appendChild(o)),o.appendChild(n);try{var d=null;e&&"UTF-8"!=document.charset.toUpperCase()&&(d=document.charset,document.charset="UTF-8"),n.submit()}finally{n.parentNode.removeChild(n),d&&(document.charset=d)}},c=function(){if(document.charset)return document.charset.toUpperCase();for(var e=document.getElementsByTagName("meta"),t=0;t<e.length;t++){var n=e[t],r=n.getAttribute("charset");if(r)return n.getAttribute("charset");var a=n.getAttribute("content");if(a){var i=a.toLowerCase(),o=i.indexOf("charset=");if(-1!=o){var d=i.indexOf(";",o+"charset=".length);return-1!=d?i.substring(o+"charset=".length,d):i.substring(o+"charset=".length)}}}return""},h=c(),m=function(e){return e=e||{},e.api_key=e.api_key||"",e.resourceUrl=e.resourceUrl||n,e.title=e.title||"",e.pic=e.pic||"",e.description=e.description||"",n==e.resourceUrl&&(e.images=e.images||r),e.charset=e.charset||h||"",e},u=function(t){var n="http://widget.renren.com/dialog/share",r=m(t),a=[];for(var i in r)r[i]&&a.push(i+"="+encodeURIComponent(r[i]));var o=n+"?"+a.join("&"),d=e?2048:4100,c="width=700,height=650,left=0,top=0,resizable=yes,scrollbars=1";return o.length>d?(window.open("about:blank","fwd",c),s({url:n,target:"fwd",params:r})):window.open(o,"fwd",c),!1};window.rrShareOnclick=u;var l=function(){if(!Renren.share.isReady&&"complete"===document.readyState){for(var e=document.getElementsByTagName("img"),t=[],n=0;n<e.length;n++)e[n].width>=o.imgMinWidth&&e[n].height>=o.imgMinHeight&&t.push(e[n].src);window.rrShareImgs=t,t.length>0&&(r=t.join("|")),document.addEventListener?document.removeEventListener("DOMContentLoaded",l,!1):document.detachEvent("onreadystatechange",l),a();for(var i=document.getElementsByName("xn_share"),s=i?i.length:0,c=0;s>c;c++){var h=i[c];d(h,c)}Renren.share.isReady=!0}};"complete"===document.readyState?l():document.addEventListener?(document.addEventListener("DOMContentLoaded",l,!1),window.addEventListener("load",l,!1)):(document.attachEvent("onreadystatechange",l),window.attachEvent("onload",l))},Renren.share());