jQuery(document).ready(function($){
    $.ajax({
        method: "GET",
        url: "https://anaplan.staging.wpengine.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json",
        dataType: "json"
    }).done(function(menus){

        var siteFooter = $("#site-footer");
        var footerMarkupArr = [];
        var navMarkupArr = [];
            
        $.each( menus, function( key, val ){


            var navClass = function(markup, order) {
                this.markup = markup;
                this.order = order;
            };

            var footerRegEx = /footer/gi;

            var footerMarkupClass = "<div class='col-sm-6 col-md-2'>" +
            "<h3>${menu-name}</h3>" +
            "<div class='menu-home-container'>" +
            "<ul id='menu-home-${key}' class='menu'>" +
            "${menu-li}" +
            "</ul>" +
            "</div>" +
            "</div>";

            if ( footerRegEx.test( val.menu_name ) ) {
                var menuKey = val.menu_name;
                var menuTitle = menuKey.substr(menuKey.indexOf("_") + 1, menuKey.indexOf("--") - menuKey.indexOf("_") - 1 );
                var menuOrder = parseInt(menuKey.substr(menuKey.indexOf("--") + 2, menuKey.length));
                footerMarkupClass = footerMarkupClass.replace(/\$\{menu-name\}/gi, menuTitle);
                footerMarkupClass = footerMarkupClass.replace(/\$\{key\}/gi, menuOrder);
                $.each( val.menu, function( key, child ) {
                    var footerLiMarkup="";
                    $.each(child, function(key, val){
                        footerLiMarkup += "<li class='menu'><a href='" + val.url + "'>" + val.name + "</a></li>";
                    }); 
                    footerMarkupClass = footerMarkupClass.replace(/\$\{menu\-li\}/gi, footerLiMarkup);
                    //console.log(footerMarkupClass);
                });

                var newObject = new navClass(footerMarkupClass, menuOrder);
                footerMarkupArr.push(newObject);
            } else if ( val.menu_name === "Main Nav" ) {
                var navMarkupClassContainer = "<ul id='primary-menu' class='menu'>${navMarkupLi}</ul>";
                $.each( val.menu, function(key, menuVal) {
                    $.each(menuVal, function(key, miniVal){
                        console.log(miniVal);

                        /*

                        Check for submenus that are single column

                        */

                        var submenuModifierClass = miniVal.classes.substr(miniVal.classes.indexOf("jet-menu-"), miniVal.classes.length).replace("jet-menu", "sub-menu");
                        submenuModifierClass = submenuModifierClass.replace(/\,/gi, " ");
                        submenuModifierClass = ( submenuModifierClass.indexOf("left") > 0 ) ? "sub-menu-50 " + submenuModifierClass:submenuModifierClass;

                        var menuOrder = miniVal.order;

                        /*
                        
                        Check for submenu children
                        
                        */

                        var submenuChildrenPresent = typeof miniVal.children !== "undefined";

                        var liMenuClass = ( submenuChildrenPresent ) ? "sub-menu-dropdown menu-item " + submenuModifierClass : "menu-item";
                        var chevronDown = ( submenuChildrenPresent ) ? " <i style='display:inline-block;' class='fa fa-chevron-down'></i>" : "";
                        var liAnchor = "<a href='${href}'>${title}${chevron}</a>";
                        liAnchor = liAnchor.replace(/\$\{href\}/gi, miniVal.url);
                        liAnchor = liAnchor.replace(/\$\{title\}/gi, miniVal.name);
                        liAnchor = liAnchor.replace(/\$\{chevron\}/gi, chevronDown);
                        //Markup for each li in the primary navigation
                        var navMarkupClass = "<li class='${classes}'>${anchor}${submenu}</li>";
                        navMarkupClass = navMarkupClass.replace(/\$\{key\}/gi, key);
                        navMarkupClass = navMarkupClass.replace(/\$\{classes\}/gi, liMenuClass);
                        navMarkupClass = navMarkupClass.replace(/\$\{anchor\}/gi, liAnchor);
                        if ( submenuChildrenPresent === true ) {
                            var subMenu = "<ul class='sub-menu' style='max-height:0;'>${submenu}</ul>";
    
                            /*

                            Builds out children below submenu title

                            */

                            var subchildrenBuild = function ( arr ) {
                                var subChildrenMarkup = [];
                                var subChildrenBuildLoop = function ( num ) {
                                    if ( num < arr.length ) {
                                        var markup = "<li class='menu-item'>${anchor}</li>";
                                        var liAnchor = "<a href='${href}'>${title}</a>";
                                        liAnchor = liAnchor.replace(/\$\{href\}/gi, arr[num].url);
                                        liAnchor = liAnchor.replace(/\$\{title\}/gi, arr[num].name);
                                        markup = markup.replace(/\$\{anchor\}/gi, liAnchor);
                                        subChildrenMarkup.push(markup);
                                        num++;
                                        subChildrenBuildLoop(num);
                                    }
                                };
                                subChildrenBuildLoop(0);
                                return subChildrenMarkup.join("");
                            };
    
                            /*

                            Builds out submenu column by column

                            */
                        
                            var childrenBuild = function ( arr ) {
                                var childrenMarkup = [];
                                var childrenBuildLoop = function (num) {
                                    if ( num < arr.length ) {
                                        //initiate subChildrenMarkup build
                                        var subChildrenMarkup = subchildrenBuild(arr[num].sub_children);
                                        var childrenSubMenu = subMenu.replace(/\$\{submenu\}/gi, subChildrenMarkup);
    
                                        //build children markup
                                        var markup = "<li class='sub-menu-title menu-item'>${anchor}${submenuChildren}</li>";
                                        var liAnchor = "<a href='${href}'>${title}</a>";
                                        liAnchor = liAnchor.replace(/\$\{href\}/gi, arr[num].url);
                                        liAnchor = liAnchor.replace(/\$\{title\}/gi, arr[num].name);
                                        markup = markup.replace(/\$\{anchor\}/gi, liAnchor);
                                        markup = markup.replace(/\$\{submenuChildren\}/gi, childrenSubMenu);
                                        childrenMarkup.push(markup);
                                        num++;
                                        childrenBuildLoop(num);
                                    }
                                };
                                childrenBuildLoop(0);
                                return childrenMarkup.join("");
                            };
                            //console.log("miniVal.children");
                            //console.log(miniVal.children);
                            var subMenus = childrenBuild(miniVal.children);
                            //console.log(subMenus);
    
                            navMarkupClass = navMarkupClass.replace(/\$\{submenu\}/gi, subMenu.replace(/\$\{submenu\}/gi, subMenus));
    
                        } else {
                            navMarkupClass = navMarkupClass.replace(/\$\{submenu\}/gi, "");
                        }
                        var newObject = new navClass(navMarkupClass, menuOrder);
                        navMarkupArr.push(newObject);
                    });                
                });
                //console.log(navMarkupArr);
                var finalLiMarkup = "";
                var finalLiOrder = navMarkupArr.sort(function(a, b){
                    return a.order - b.order;
                });
                $.each(finalLiOrder, function(key, val){
                    finalLiMarkup += val.markup;
                });
                
                navMarkupClassContainer = navMarkupClassContainer.replace(/\$\{navMarkupLi\}/gi, finalLiMarkup);

                //Clear navigation if it already exists
                $("#site-navigation").html("");

                //append markup to site-navigation id
                $("<div/>", {
                    html : navMarkupClassContainer,
                    class : "menu-main-menu-container"
                }).appendTo($("#site-navigation"));


            }

        });

        //console.log(navMarkupArr);

        //Sort markup using the order key
        var finalFooterOrder = footerMarkupArr.sort(function(a, b) {
            return a.order - b.order;
        });

        //Footer is now an array of objects. Create the markup by combining the markup key from each object
        var finalFooterMarkup = "";
        $.each(finalFooterOrder, function(key, val){
            finalFooterMarkup += val.markup;
        });

        //Clear footer if one already exists
        $("#site-footer").html("");

        //append markup to site-footer id
        $("<div/>", {
            html : finalFooterMarkup,
            class : "row"
        }).appendTo(siteFooter);

    }).fail(function(jqXHR, textStatus){
        console.log("Error: File failed to load.\n\ntextStatus = " + textStatus);
    });

    $(document).on("mouseover", ".sub-menu-dropdown", function(e){
        console.log($(this).position().left);
        var selection = $(this).find(".sub-menu");
        selection.css("max-height", "500px");
        console.log(selection.css("left"));
        if ( selection.css("left") === "auto" ) {
            selection.css("left", $(this).position().left);
        }
    });
    $(document).on("mouseout", ".sub-menu-dropdown", function(e){
        var selection = $(this).find(".sub-menu");
        selection.css("max-height", "0");
    });
    $(document).on("mouseover", ".sub-menu", function(e){
        var selection = $(this);
        selection.css("max-height", "500px");
    });
    $(document).on("mouseout", ".sub-menu", function(e){
        var selection = $(this);
        selection.css("max-height", "500px");
    });
});