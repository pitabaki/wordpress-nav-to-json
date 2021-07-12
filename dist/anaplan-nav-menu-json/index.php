<?php
	/**
	 * Plugin Name:       Anaplan Menu to JSON
	 * Plugin URI:        https://www.anaplan.com/
	 * Description:       Saves a JSON file of Anaplan's navigation menus
	 * Version:           1.1.6
	 * Author:            Peter Berki
	 * Author URI:        https://kumadev.com/
	 * License:           GPL-2.0+
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:       anaplan
	 * Domain Path:       /languages
	 */

	require_once('assets/components/nav_menu_json.php');
	require_once('assets/components/nav_relative_menu_json.php');
	require_once('assets/components/nav_menu_process_deprecated.php');
	require_once('assets/components/nav_menu_process.php');

	if ( ! defined('WPINC') ) {
		die;
	}

	function nav_relative_menu_to_json() {
		$current_lang = get_locale();
		$current_host = $_SERVER['HTTP_HOST'];

		if ( $_SERVER['REQUEST_URI'] == '/fr-ch/wp-admin/nav-menus.php' ) {
			$current_lang = "fr_CH";
		}

		if ( $current_host == "anaplan.staging.wpengine.com" || $current_host == "anaplaninstdev.wpengine.com" ) {
			$menu_json_data_string = '[';
			$menu_json_data_string .= nav_relative_menu_json('Main Nav');
			$menu_json_data_string .= "]";

			//Determine file directory
			$file = dirname(__FILE__) . "/assets/public/anaplan-dotcom-main-nav-relative_$current_lang.json";

			//Print JSON content
			file_put_contents($file, $menu_json_data_string);
		} else {
			$menu_json_data_string = '[';
			$menu_json_data_string .= nav_relative_menu_json('Main Nav');
			$menu_json_data_string .= "]";

			$nav_url = $current_host . "_" . $current_lang;

			//Determine file directory
			$file = dirname(__FILE__) . "/assets/public/$nav_url.json";

			//Print JSON content
			file_put_contents($file, $menu_json_data_string);
		}
	}

	function nav_menu_to_json() {
		$current_lang = get_locale();
		$current_host = $_SERVER['HTTP_HOST'];

		if ( $_SERVER['REQUEST_URI'] == '/fr-ch/wp-admin/nav-menus.php' ) {
			$current_lang = "fr_CH";
		}

		if ( $current_host == "anaplan.staging.wpengine.com" || $current_host == "anaplaninstdev.wpengine.com" ) {
			$menu_json_data_string = '[';
			$menu_json_data_string .= nav_menu_json('Main Nav');
			$menu_json_data_string .= "]";

			//Determine file directory
			$file = dirname(__FILE__) . "/assets/public/anaplan-dotcom-main-nav_$current_lang.json";

			//Print JSON content
			file_put_contents($file, $menu_json_data_string);
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

	function nav_menu_to_jsonp() {

		$current_host = $_SERVER['HTTP_HOST'];

		$current_lang = get_locale();

        if ( $current_lang == 'en_US'  || $current_lang == 'en' || $current_lang == 'en_EN' ) {

			if ( $current_host == "anaplan.staging.wpengine.com" || $current_host == "anaplaninstdev.wpengine.com" ) {

				$response_container = "response(%s)";

				$menu_json_data_string = '[';
				$menu_json_data_string .= nav_menu_json('Main Nav');
				$menu_json_data_string .= "]";

				$response_container_print = sprintf($response_container, $menu_json_data_string);

				//Determine file directory
				$file = dirname(__FILE__) . '/assets/public/anaplan-dotcom-main-nav-jsonp.json';

				//Print JSON content
				file_put_contents($file, $response_container_print);

			}

		}

	}

	add_action( 'wp_update_nav_menu', 'nav_relative_menu_to_json' );
	add_action( 'wp_update_nav_menu', 'nav_menu_to_json' );
	add_action( 'wp_update_nav_menu', 'nav_menu_to_jsonp' );

 ?>