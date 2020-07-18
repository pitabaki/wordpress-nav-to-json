<?php

    function Menu_JSON_Format( $menu ) {
        //echo "sub_menu_item_array" . json_encode($sub_menu_item_array). "\n\n";
        $each_menu_item_link_name = $menu -> get_link_name();

        $each_menu_item_link_value = str_replace("anaplan.staging.wpengine", "www.anaplan", $menu -> get_link_value());
        $each_menu_item_link_value = ( strpos($each_menu_item_link_value, ".com") === false ) ? "https://www.anaplan.com" . $each_menu_item_link_value : $each_menu_item_link_value;
        $each_menu_item_object_id = $menu -> get_object_id();
        $each_menu_item_slug = strtolower(str_replace(" ", "_", $each_menu_item_link_name));

        $obj = $menu -> get_object();
        $each_menu_item_string = '{ "id": "'.$each_menu_item_object_id .
            '", "url":"'. $each_menu_item_link_value .
            '","name":"'.$each_menu_item_link_name.'"';
        
        return $each_menu_item_string;
    }

?>