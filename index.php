<?php
	/**
	 * Plugin Name:       Anaplan Menu to JSON
	 * Plugin URI:        https://www.anaplan.com/
	 * Description:       Saves a JSON file of Anaplan's navigation menus
	 * Version:           1.0.1
	 * Author:            Peter Berki
	 * Author URI:        https://kumadev.com/
	 * License:           GPL-2.0+
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:       anaplan
	 * Domain Path:       /languages
	 */

	require_once('assets/actions/nav_menu_process.php');


	if ( ! defined('WPINC') ) {
		die;
	}

	function menu_to_json_test() {
            
		
		$menus = ["Main Nav"]; //for testing
		$menu_json_data_string_obj = "[";

		for ( $i=0; $i < count($menus); $i++ ) {
			$json_string_end = ( $i + 1 === count($menus) ) ? "]}]" : "]},";
			$menu_json_data_string = nav_menu_process($menus[$i]);
			$menu_json_data_string_obj .= '{"menu_name":"' . $menus[$i] .'","menu":[' . $menu_json_data_string . $json_string_end;
		}
        
		//$menu_items = wp_get_nav_menu_items($menu->term_id);

		//JSON encoding
		//$json_string = json_encode($menu_items);

		//Determine file directory
		$file = dirname(__FILE__) . '/assets/public/anaplan-main-menu.json';

		//Print JSON content
		file_put_contents($file, $menu_json_data_string_obj);
			
	}
	
	function menu_to_json() {
		
		$menus = get_terms( 'nav_menu' );
		$menu_json_data_string_obj = "[";
		for ( $i=0; $i < count($menus); $i++ ) {
			$json_string_end = ( $i + 1 === count($menus) ) ? "]}]" : "]},";
			$menu_json_data_string = nav_menu_process($menus[$i]->name);
			$menu_json_data_string_obj .= '{"menu_name":"' . $menus[$i]->name .'","menu":[' . $menu_json_data_string . $json_string_end;
		}

		//Determine file directory
		$file = dirname(__FILE__) . '/assets/public/anaplan-main-menu.json';

		//Print JSON content
		file_put_contents($file, $menu_json_data_string_obj);

	}

	add_action( 'wp_update_nav_menu', 'menu_to_json' );
	//add_action( 'wp_update_nav_menu', 'menu_to_json_test' );

	//echo "works";
 ?>