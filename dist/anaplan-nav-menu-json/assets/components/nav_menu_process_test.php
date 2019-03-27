<?php
    require_once(__DIR__ . '/../controller/Menu_Item_Test.php');
    
    function nav_menu_process_test( $pass_menu_name ) {
        $menu_name = $pass_menu_name; //menu name (declared by user) and pulled by get request from wp
        
        if ( $menu_name ) {

            $menu = wp_get_nav_menu_object($menu_name);
            
            $menu_items = wp_get_nav_menu_items($menu->term_id);

            for( $i = 0; $i < count($menu_items); $i += 1 ){

                $current_menu_item_obj = $menu_items[$i];
            
                if($current_menu_item_obj->menu_item_parent == "0"){ //main menu item found
                    //define a new menu_item object
                    //echo implode(",", $current_menu_item_obj->classes);
                    $menu_item_obj = new Menu_Item_Test($current_menu_item_obj->object, $current_menu_item_obj->object_id, $current_menu_item_obj->title, $current_menu_item_obj->url, implode(",", $current_menu_item_obj->classes));
                    echo $menu_item_obj -> get_classes();
                    //$main_menu_item_array[$current_menu_item_obj->ID] = $menu_item_obj;
                }

            }
        }
        
    }
?>