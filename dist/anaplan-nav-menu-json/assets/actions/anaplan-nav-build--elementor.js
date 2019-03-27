jQuery(document).ready(function($){
    $.ajax({
        method: "GET",
        url: "https://anaplan.staging.wpengine.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json",
        dataType: "json"
    }).done(function(menus){

        var siteFooter = $("#site-footer");
        var footerMarkupArr = [];
            
        $.each( menus, function( key, val ){

            var footerClass = function(markup, order) {
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

                var newObject = new footerClass(footerMarkupClass, menuOrder);
                footerMarkupArr.push(newObject);
            }

        });


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
});