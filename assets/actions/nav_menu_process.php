<?php
    require_once(__DIR__ . '/../controller/Menu_Item.php');
    
    function nav_menu_process( $pass_menu_name ) {
        $menu_name = $pass_menu_name; //menu name (declared by user)
        $menu_json_data_string = '{';
        
        if ($menu_name) {
        $menu = wp_get_nav_menu_object( $menu_name );
        
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        
        //initialize two menu item arrays
        $main_menu_item_array = array();
        $sub_menu_item_array = array();//defined as 2d array
        //define two menu item arrays first
        for( $i = 0; $i < count($menu_items); $i += 1 ){
            $current_menu_item_obj = $menu_items[$i];
        
            if($current_menu_item_obj->menu_item_parent == "0"){ //main menu item found
                //define a new menu_item object
                $menu_item_obj = new Menu_Item($current_menu_item_obj->object, $current_menu_item_obj->object_id, $current_menu_item_obj->title, $current_menu_item_obj->url);
                $main_menu_item_array[$current_menu_item_obj->ID] = $menu_item_obj;
            } else { //sub menu found
                $menu_item_obj = new Menu_Item($current_menu_item_obj->object, $current_menu_item_obj->object_id, $current_menu_item_obj->title, $current_menu_item_obj->url);
                $sub_menu_item_array[$current_menu_item_obj->menu_item_parent][] = $menu_item_obj;
            }
        }
        
        $menu_item_json_array = array();
        foreach( $main_menu_item_array as $each_main_menu_key => $each_main_menu_item ){
            $each_menu_item_link_name = $each_main_menu_item -> get_link_name();
            $each_menu_item_link_value = $each_main_menu_item -> get_link_value();
            $each_menu_item_object_id = $each_main_menu_item -> get_object_id();
            $each_menu_item_slug = strtolower(str_replace(" ", "_", $each_menu_item_link_name));
            $obj = $each_main_menu_item -> get_object();
            $type = ($obj=='meta_category') ? 'meta' : 'main';
            $each_menu_item_string = '"'.$each_menu_item_slug.'":{"id": "'.$each_menu_item_object_id.'", "type": "'.$type.'", "url":"'.$each_menu_item_link_value.'","name":"'.$each_menu_item_link_name.'"';
        
            if ( array_key_exists($each_main_menu_key, $sub_menu_item_array) ) { //has sub menu item
            //count submenu items
            $count_sub_menu_item = count($sub_menu_item_array[$each_main_menu_key]);
            //put each sub menu item into an array
            $submenu_item_list_main_string = ',"children": [';
            $submenu_item_list_array = array();
            foreach( $sub_menu_item_array[$each_main_menu_key] as $each_sub_menu_item ){
                $obj = $each_sub_menu_item->get_object();
                $type = ($obj=='meta_category')?'meta':'main';
                $each_sub_menu_item_string = '{"id": "'.$each_sub_menu_item->get_object_id().'", "type": "'.$type.'", "url":"'.$each_sub_menu_item->get_link_value().'", "name":"'.$each_sub_menu_item->get_link_name().'"}';
                $submenu_item_list_array[] = $each_sub_menu_item_string;
            }
            $submenu_item_list_string = implode(",", $submenu_item_list_array);
            $submenu_item_list_main_string .= $submenu_item_list_string;
            $submenu_item_list_main_string .= ']';
            $each_menu_item_string .= $submenu_item_list_main_string;
            }
            $each_menu_item_string .= '}';
            $menu_item_json_array[] = $each_menu_item_string;
        }
        $menu_item_json_string = implode(",", $menu_item_json_array);
        }
        
        $menu_json_data_string .= $menu_item_json_string;
        $menu_json_data_string .= '}';
        return $menu_json_data_string;
    }
?>