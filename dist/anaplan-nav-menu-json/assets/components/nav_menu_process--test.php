<?php
    require_once(__DIR__ . '/../controller/Menu_Item.php');
    
    function nav_menu_process( $pass_menu_name ) {
        $menu_name = $pass_menu_name; //menu name (declared by user) and pulled by get request from wp
        
        if ( $menu_name ) {

            $menu = wp_get_nav_menu_object($menu_name);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            for( $i = 0; $i < count($menu_items); $i += 1 ){

                $current_menu_item_obj = $menu_items[$i];
                echo $current_menu_item_obj->title;
            }
        }
        
    }
?>