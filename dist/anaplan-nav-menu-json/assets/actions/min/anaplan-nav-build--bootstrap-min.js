jQuery(document).ready(function(e){e.ajax({method:"GET",url:"https://anaplan.staging.wpengine.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json",dataType:"json"}).done(function(n){var a=e("#site-footer"),i=[],u=[];e.each(n,function(n,a){var s=function(e,n){this.markup=e,this.order=n},r="<div class='col-sm-6 col-md-2'><h3>${menu-name}</h3><div class='menu-home-container'><ul id='menu-home-${key}' class='menu'>${menu-li}</ul></div></div>";if(/footer/gi.test(a.menu_name)){var t=a.menu_name,l=t.substr(t.indexOf("_")+1,t.indexOf("--")-t.indexOf("_")-1),o=parseInt(t.substr(t.indexOf("--")+2,t.length));r=(r=r.replace(/\$\{menu-name\}/gi,l)).replace(/\$\{key\}/gi,o),e.each(a.menu,function(n,a){var i="";e.each(a,function(e,n){i+="<li class='menu'><a href='"+n.url+"'>"+n.name+"</a></li>"}),r=r.replace(/\$\{menu\-li\}/gi,i)});var c=new s(r,o);i.push(c)}else if("Main Nav"===a.menu_name){var m="<ul id='primary-menu' class='menu'>${navMarkupLi}</ul>";e.each(a.menu,function(n,a){e.each(a,function(e,n){console.log(n);var a=n.classes.substr(n.classes.indexOf("jet-menu-"),n.classes.length).replace("jet-menu","sub-menu");a=(a=a.replace(/\,/gi," ")).indexOf("left")>0?"sub-menu-50 "+a:a;var i=n.order,r=void 0!==n.children,t=r?"sub-menu-dropdown menu-item "+a:"menu-item",l=r?" <i style='display:inline-block;' class='fa fa-chevron-down'></i>":"",o="<a href='${href}'>${title}${chevron}</a>";o=(o=(o=o.replace(/\$\{href\}/gi,n.url)).replace(/\$\{title\}/gi,n.name)).replace(/\$\{chevron\}/gi,l);var c,m,h,f="<li class='${classes}'>${anchor}${submenu}</li>";if(f=(f=(f=f.replace(/\$\{key\}/gi,e)).replace(/\$\{classes\}/gi,t)).replace(/\$\{anchor\}/gi,o),!0===r){var p="<ul class='sub-menu' style='max-height:0;'>${submenu}</ul>",d=(c=n.children,m=[],(h=function(e){if(e<c.length){var n=function(e){var n=[],a=function(i){if(i<e.length){var u="<li class='menu-item'>${anchor}</li>",s="<a href='${href}'>${title}</a>";s=(s=s.replace(/\$\{href\}/gi,e[i].url)).replace(/\$\{title\}/gi,e[i].name),u=u.replace(/\$\{anchor\}/gi,s),n.push(u),a(++i)}};return a(0),n.join("")}(c[e].sub_children),a=p.replace(/\$\{submenu\}/gi,n),i="<li class='sub-menu-title menu-item'>${anchor}${submenuChildren}</li>",u="<a href='${href}'>${title}</a>";u=(u=u.replace(/\$\{href\}/gi,c[e].url)).replace(/\$\{title\}/gi,c[e].name),i=(i=i.replace(/\$\{anchor\}/gi,u)).replace(/\$\{submenuChildren\}/gi,a),m.push(i),h(++e)}})(0),m.join(""));f=f.replace(/\$\{submenu\}/gi,p.replace(/\$\{submenu\}/gi,d))}else f=f.replace(/\$\{submenu\}/gi,"");var g=new s(f,i);u.push(g)})});var h="",f=u.sort(function(e,n){return e.order-n.order});e.each(f,function(e,n){h+=n.markup}),m=m.replace(/\$\{navMarkupLi\}/gi,h),e("#site-navigation").html(""),e("<div/>",{html:m,class:"menu-main-menu-container"}).appendTo(e("#site-navigation"))}});var s=i.sort(function(e,n){return e.order-n.order}),r="";e.each(s,function(e,n){r+=n.markup}),e("#site-footer").html(""),e("<div/>",{html:r,class:"row"}).appendTo(a)}).fail(function(e,n){console.log("Error: File failed to load.\n\ntextStatus = "+n)}),e(document).on("mouseover",".sub-menu-dropdown",function(n){console.log(e(this).position().left);var a=e(this).find(".sub-menu");a.css("max-height","500px"),console.log(a.css("left")),"auto"===a.css("left")&&a.css("left",e(this).position().left)}),e(document).on("mouseout",".sub-menu-dropdown",function(n){e(this).find(".sub-menu").css("max-height","0")}),e(document).on("mouseover",".sub-menu",function(n){e(this).css("max-height","500px")}),e(document).on("mouseout",".sub-menu",function(n){e(this).css("max-height","500px")})});