jQuery(document).ready(function(e){!0===(!0!==/(\/fr\/)|(\/de\/)|(\/ru\/)|(\/jp\/)/gi.test(window.location.href))&&e.ajax({method:"GET",url:"https://anaplan.staging.wpengine.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json",dataType:"json"}).done(function(a){var n=e("#site-footer"),s=[],i=[];n.hasClass("site-footer")||n.addClass("site-footer"),e.each(a,function(a,n){var l=function(e,a){this.markup=e,this.order=a},o="<div class='col-sm-6 col-md-2'><h3>${menu-name}</h3><div class='menu-home-container'><ul id='menu-home-${key}' class='menu'>${menu-li}</ul></div></div>";if(/footer/gi.test(n.menu_name)){var t=n.menu_name,r=t.substr(t.indexOf("_")+1,t.indexOf("--")-t.indexOf("_")-1),c=parseInt(t.substr(t.indexOf("--")+2,t.length));o=(o=o.replace(/\$\{menu-name\}/gi,r)).replace(/\$\{key\}/gi,c),e.each(n.menu,function(a,n){var s="";e.each(n,function(e,a){s+="<li class='menu'><a href='"+a.url+"'>"+a.name+"</a></li>"}),o=o.replace(/\$\{menu\-li\}/gi,s)});var u=new l(o,c);s.push(u)}else if("Main Nav"===n.menu_name){var m="<ul id='primary-menu' class='menu'>${navMarkupLi}</ul>";e.each(n.menu,function(a,n){e.each(n,function(e,a){console.log(a);var n=a.classes.substr(a.classes.indexOf("jet-menu-"),a.classes.length).replace("jet-menu","sub-menu");n=(n=n.replace(/\,/gi," ")).indexOf("left")>0?"sub-menu-50 "+n:n;var s=a.order,o=void 0!==a.children,t=o?"sub-menu-dropdown menu-item "+n:"menu-item",r=o?" <i style='display:flex;' class='fa fa-chevron-down'></i>":"",c="<a href='${href}'>${title}${chevron}</a>";c=(c=(c=c.replace(/\$\{href\}/gi,a.url)).replace(/\$\{title\}/gi,a.name)).replace(/\$\{chevron\}/gi,r);var u,m,f,p="<li class='${classes}'>${anchor}${submenu}</li>";if(p=(p=(p=p.replace(/\$\{key\}/gi,e)).replace(/\$\{classes\}/gi,t)).replace(/\$\{anchor\}/gi,c),!0===o){var h="<ul class='sub-menu' style='max-height:0;'>${submenu}</ul>",g=(u=a.children,m=[],(f=function(e){if(e<u.length){if(void 0!==u[e].sub_children)var a=function(e){var a=[],n=/(\.png)|(\.jpg)|(img)/gi,s=!1,i=function(l){if(l<e.length){if(n.test(e[l].url)){var o="<li class='submenu-img menu-item'>${img}</li>",t="<img src='${src}' alt='${alt}'/>";t=(t=t.replace(/\$\{src\}/gi,e[l].url)).replace(/\$\{alt\}/gi,e[l].name.replace("img","")),o=o.replace(/\$\{img\}/gi,t),s=!0}else{o=s?"<li class='sub-menu-button menu-item'>${anchor}</li>":"<li class='menu-item'>${anchor}</li>";var r="<a href='${href}'>${title}</a>";r=(r=r.replace(/\$\{href\}/gi,e[l].url)).replace(/\$\{title\}/gi,e[l].name),o=o.replace(/\$\{anchor\}/gi,r),!0===s&&(s=!1)}a.push(o),i(++l)}};return i(0),a.join("")}(u[e].sub_children),n=h.replace(/\$\{submenu\}/gi,a);var s="<li class='sub-menu-title menu-item'>${anchor}${submenuChildren}</li>",i="<a href='${href}'>${title}</a>";i=(i=i.replace(/\$\{href\}/gi,u[e].url)).replace(/\$\{title\}/gi,u[e].name),s=(s=s.replace(/\$\{anchor\}/gi,i)).replace(/\$\{submenuChildren\}/gi,n),m.push(s),f(++e)}})(0),m.join(""));p=p.replace(/\$\{submenu\}/gi,h.replace(/\$\{submenu\}/gi,g))}else p=p.replace(/\$\{submenu\}/gi,"");var d=new l(p,s);i.push(d)})});var f="",p=i.sort(function(e,a){return e.order-a.order});e.each(p,function(e,a){f+=a.markup}),m=m.replace(/\$\{navMarkupLi\}/gi,f);var h=e("#site-navigation").length>0?e("#site-navigation"):e(".ast-main-header-bar-alignment").eq(0);h.html(""),e("<div/>",{html:m,class:"menu-main-menu-container"}).appendTo(h)}});var l=s.sort(function(e,a){return e.order-a.order}),o="";e.each(l,function(e,a){o+=a.markup}),0===e(".footer-social").length&&(o+="<div class='col-sm-12 col-md-12'><div class='footer-social'><h3>Social</h3><ul class='footer-social-wrap'><li><a class='footer-social-icon' href='http://www.linkedin.com/company/658814' target='_blank'><span class='footer-social-screen-only'>Linkedin</span><i class='fa fa-linkedin'></i></a></li><li><a class='footer-social-icon' href='https://www.facebook.com/anaplan' target='_blank'><span class='footer-social-screen-only'>Facebook</span> <i class='fa fa-facebook'></i></a></li><li><a class='footer-social-icon' href='http://www.twitter.com/anaplan' target='_blank'><span class='footer-social-screen-only'>Twitter</span><i class='fa fa-twitter'></i></a></li><li><a class='footer-social-icon' href='https://plus.google.com/+AnaplanInc/' target='_blank'><span class='footer-social-screen-only'>Google-plus</span><i class='fa fa-google-plus'></i></a></li><li><a class='footer-social-icon' href='https://www.instagram.com/anaplanning/' target='_blank'><span class='footer-social-screen-only'>Instagram</span><i class='fa fa-instagram'></i></a></li></ul></div></div>"),e("#site-footer").html(""),e("<div/>",{html:o,class:"row"}).appendTo(n)}).fail(function(e,a){console.log("Error: File failed to load.\n\ntextStatus = "+a)}),e(document).on("mouseover",".sub-menu-dropdown",function(a){console.log(a.type);var n=e(this).children(".sub-menu"),s=parseInt(n.css("width"));if(n.css("max-height","600px"),!1===n.hasClass("left-update")){var i=parseInt(e(this).position().left-s/2);console.log(i),n.css("left",i),n.addClass("left-update")}}),e(document).on("mouseout",".sub-menu-dropdown",function(a){console.log(a.type),e(this).find(".sub-menu").css("max-height","0")}),e(document).on("mouseover",".sub-menu",function(a){e(this).css("max-height","600px")}),e(document).on("mouseout",".sub-menu",function(a){e(this).css("max-height","600px")})});