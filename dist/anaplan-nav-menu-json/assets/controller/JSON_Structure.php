<?php

    class JSON_Structure
    {
        private $menu;
      
        public function __construct($menu){
          $this->title = $menu->get_link_name();
          $this->href = $menu->get_link_value();
        }
      
        public function get_href(){
          $current_url = $this->href;
          $check_url_staging = str_replace("anaplan.staging.wpengine", "www.anaplan", $current_url);
          $return_url = ( strpos($check_url_staging, ".com") === false ) ? "https://www.anaplan.com" . $check_url_staging : $check_url_staging;
          return $return_url;
        }

        public function get_menu_json(){
            $current_url = $this->href;
            $check_url_staging = str_replace("anaplan.staging.wpengine", "www.anaplan", $current_url);
            $return_url = ( strpos($check_url_staging, ".com") === false ) ? "https://www.anaplan.com" . $check_url_staging : $check_url_staging;
            $title = ( strlen($this->title) > 0 && $this->title != "Remove" ) ? $this->title:"";
            $href_final = ( strlen($current_url) > 0 ) ? $return_url : "";
            return '{ "title": "'. $title .
                '", "href":"'. $href_final .
                '", "description":"' .
                '", "currentLink": "false"';
        }

        public function get_relative_menu_json(){
          $current_url = $this->href;
          $return_url = str_replace("anaplan.staging.wpengine", "www.anaplan", $current_url);
          $title = ( strlen($this->title) > 0 && $this->title != "Remove" ) ? $this->title:"";
          $href_final = ( strlen($current_url) > 0 ) ? $return_url : "";
          return '{ "title": "'. $title .
              '", "href":"'. $href_final .
              '", "description":"' .
              '", "currentLink": "false"';
      }
      
    }
    
?>