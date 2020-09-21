<?php
    require_once(__DIR__ . '/../controller/Menu_Item.php');
    require_once(__DIR__ . '/../controller/JSON_Structure.php');

    function nav_relative_menu_json ( $pass_menu_name ) {
        
        //$menu_json_data_string = '[';

        if ( $pass_menu_name ) {

            //$menu = wp_get_nav_menu_object($menu_name);
            
            //$menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_items = wp_get_nav_menu_items($pass_menu_name);

            //initialize two menu item arrays
            $main_menu_item_array = array();
            $sub_menu_item_array = array();//defined as 2d array
            //define two menu item arrays first
            for ( $i = 0; $i < count($menu_items); $i++ ) {

                $current_menu_item_obj = $menu_items[$i];

                if($current_menu_item_obj->menu_item_parent == "0"){ //main menu item found NO SUB MENU
                    //define a new menu_item object
                    $menu_item_obj = new Menu_Item($current_menu_item_obj->object, $current_menu_item_obj->object_id, $current_menu_item_obj->title, $current_menu_item_obj->url, implode(",", $current_menu_item_obj->classes));
                    $main_menu_item_array[$current_menu_item_obj->ID] = $menu_item_obj;
                } else {
                    //sub menu found
                    $menu_item_obj = new Menu_Item($current_menu_item_obj->object, $current_menu_item_obj->object_id, $current_menu_item_obj->title, $current_menu_item_obj->url, implode(",", $current_menu_item_obj->classes));
                    $sub_menu_item_array[$current_menu_item_obj->menu_item_parent][] = $menu_item_obj;
                }

            }
            //print_r($sub_menu_item_array);
            $menu_item_json_array = array();
            foreach( $main_menu_item_array as $each_main_menu_key => $each_main_menu_item ){

                $menu_level_one_obj = new JSON_Structure($each_main_menu_item);
                $each_menu_item_string = $menu_level_one_obj->get_relative_menu_json();

                if ( array_key_exists($each_main_menu_key, $sub_menu_item_array) ) { //has sub menu item
                    //put each sub menu item into an array
                    $submenu_item_list_main_string = ',"children": [';
                    $submenu_item_list_array = array();

                    foreach( $sub_menu_item_array[$each_main_menu_key] as $each_sub_menu_item ){

                        $each_sub_menu_item_id = $each_sub_menu_item->get_object_id();
                        $menu_level_two_obj = new JSON_Structure($each_sub_menu_item);
                        $each_sub_menu_item_string = $menu_level_two_obj->get_relative_menu_json();

                        if ( array_key_exists($each_sub_menu_item_id, $sub_menu_item_array) ) {
                            $count_sub_sub_menu_item = count($sub_menu_item_array[$each_sub_menu_item_id]);
                            $submenu_sub_item_list_main_string = ',"children": [';
                            $submenu_sub_item_list_array = array();

                            foreach( $sub_menu_item_array[$each_sub_menu_item_id] as $each_sub_sub_menu_item ) {

                                $menu_level_three_obj = new JSON_Structure($each_sub_sub_menu_item);
                                $each_sub_sub_menu_item_string = $menu_level_three_obj->get_relative_menu_json() . '}';
                                $submenu_sub_item_list_array[] = $each_sub_sub_menu_item_string;
                            }

                            $submenu_sub_item_list_string = implode(",", $submenu_sub_item_list_array);
                            $submenu_sub_item_list_main_string .= $submenu_sub_item_list_string;
                            $submenu_sub_item_list_main_string .= ']';
                            $each_sub_menu_item_string .= $submenu_sub_item_list_main_string;

                        }

                        $each_sub_menu_item_string .= '}';
                        $submenu_item_list_array[] = $each_sub_menu_item_string;

                    }

                    $submenu_item_list_string = implode(",", $submenu_item_list_array);
                    $submenu_item_list_main_string .= $submenu_item_list_string;
                    $submenu_item_list_main_string .= ']';
                    $each_menu_item_string .= $submenu_item_list_main_string .= '}';

                } else {
                    $each_menu_item_string .= ',"children": []}';
                }

                $menu_item_json_array[] = $each_menu_item_string;
            }
            $menu_item_json_string = implode(",", $menu_item_json_array);
        }

        $menu_json_data_string .= $menu_item_json_string;
        //$menu_json_data_string .= ']';
        return $menu_json_data_string; 
    }

?>