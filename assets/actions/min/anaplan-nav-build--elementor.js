<script type="text/javascript">
jQuery(document).ready(function($){
    $.ajax({
        method: "GET",
        url: "https://anaplan.staging.wpengine.com/wp-content/plugins/anaplan-nav-menu-json/assets/public/anaplan-main-menu.json"
    }).done(function(message){
        console.log(message);
    }).fail(function(jqXHR, textStatus){
        console.log("Error: File failed to load.\n\ntextStatus = " + textStatus);
    });
});
</script>

