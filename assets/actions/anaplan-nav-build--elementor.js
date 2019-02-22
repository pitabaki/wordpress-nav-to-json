jQuery(document).ready(function($){
    $.ajax({
        method: "GET",
        url: "https://www.anaplan.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json"
    }).done(function(message){
        console.log(message);
    }).fail(function(jqXHR, textStatus){
        console.log("Error: File failed to load.\n\ntextStatus = " + textStatus);
    });
});