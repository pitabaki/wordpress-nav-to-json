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

	require_once('assets/components/nav_menu_process_test.php');
	require_once('assets/components/nav_menu_process_deprecated.php');
	require_once('assets/components/nav_menu_process.php');

	if ( ! defined('WPINC') ) {
		die;
	}

	function menu_to_json_test() {
		echo "menu_to_json_test() processing";
		$menus = get_terms( 'nav_menu' );
		for ( $i=0; $i < count($menus); $i++ ) {
			$menu_json_data_string = nav_menu_process_test($menus[$i]->name);
		}
	}
	
	function menu_to_json() {

		$current_host = $_SERVER["HTTP_HOST"];
		if ( $current_host === "anaplan.com" || $current_host === "www.anaplan.com" || $current_host === "anaplan.staging.wpengine.com" ) {
		
			$menus = get_terms( 'nav_menu' );
			$menu_json_data_string_obj = "[";
			for ( $i=0; $i < count($menus); $i++ ) {
				$json_string_end = ( $i + 1 === count($menus) ) ? "]}]" : "]},";
				$menu_json_data_string = nav_menu_process_deprecated($menus[$i]->name);
				$menu_json_data_string_obj .= '{"menu_name":"' . $menus[$i]->name .'","menu":[' . $menu_json_data_string . $json_string_end;
			}

			//Determine file directory
			$file = dirname(__FILE__) . '/assets/public/anaplan-main-menu.json';

			//Print JSON content
			file_put_contents($file, $menu_json_data_string_obj);

		}

	}

	function get_footer_name($menu_name) {
		$updated_menu_name = substr($menu_name, strpos($menu_name, "_") + 1, strpos($menu_name, "-") - strlen($menu_name));
		return $updated_menu_name;
	}

	function get_footer_order($menu_name) {
		$footer_order = substr($menu_name, strpos($menu_name, "--") + 2, strlen($menu_name));
		return $footer_order;
	}

	function menu_to_jsonp() {

		$current_host = $_SERVER["HTTP_HOST"];

		if ( $current_host === "anaplan.com" || $current_host === "www.anaplan.com" || $current_host === "anaplan.staging.wpengine.com" ) {
		
			$response_container = "response([%s])";
			$navigation_menu = '{"container":"Navigation","item":[%s]}';
			$footer_menu = '{"container":"Footer","item":[%s]}';

			//Declare arrays to push menus
			$navigation_arr = [];
			$footer_arr = [];
			$combined_arr = [];

			//Gather all WP nav menus
			$menus = get_terms( 'nav_menu' );

			for ( $i=0; $i < count($menus); $i++ ) {

				//Make request with original name
				$menu_json_data_string = nav_menu_process($menus[$i]->name);

				if ( strpos($menus[$i]->name, "Footer" ) !== false ) {
					//For footers, determine name based on structure
					$menu_name = get_footer_name($menus[$i]->name);
					$menu_order = get_footer_order($menus[$i]->name);
					$menu_json_data_string_obj = '{"menu_name":"' . $menu_name .'", "menu_heading": "'.$menu_name.'", "menu_order":"'.$menu_order.'", "menu":[' . $menu_json_data_string . ']}';
					array_push($footer_arr, $menu_json_data_string_obj);
				} else if ( preg_match('/(Top Nav)|(Main Nav)/', $menus[$i]->name ) ) {
					$menu_name = $menus[$i]->name;
					$menu_json_data_string_obj = '{"menu_name":"' . $menu_name .'","menu":[' . $menu_json_data_string . ']}';
					array_push($navigation_arr, $menu_json_data_string_obj);
				}

			}

			$footer_arr = join(",", $footer_arr);
			$navigation_arr = join(",", $navigation_arr);

			$navigation_menu = sprintf($navigation_menu, $navigation_arr);
			$footer_menu = sprintf($footer_menu, $footer_arr);

			$combined_arr = [$navigation_menu, $footer_menu];
			$combined_arr = join(",", $combined_arr);

			$response_container = sprintf($response_container, $combined_arr);

			//Determine file directory
			$file = dirname(__FILE__) . '/assets/public/anaplan-main-menu-nav.json';

			//Print JSON content
			file_put_contents($file, $response_container);

		}

	}

	
	function update_nav_menus() {
		$current_host = $_SERVER["HTTP_HOST"];
		if ( $current_host !== "anaplan.com" && $current_host !== "www.anaplan.com" && $current_host !== "anaplan.staging.wpengine.com" ) {
			//offload JS file here
			wp_enqueue_script( 'anaplan-nav-menu', plugins_url() . '/anaplan-nav-menu-json/assets/actions/anaplan-nav-build--bootstrap.js', ['jquery'] );
			wp_enqueue_style( 'anaplan-nav-menu-style', plugins_url() . '/anaplan-nav-menu-json/assets/components/css/style.css' );
		}
	}

	add_action( 'wp_update_nav_menu', 'menu_to_jsonp' );
	/* This is deprecated. Begin working this out */
	add_action( 'wp_update_nav_menu', 'menu_to_json' );
	//add_action( 'wp_update_nav_menu', 'menu_to_json_test' );
	add_action( 'init', 'update_nav_menus' );

 ?>