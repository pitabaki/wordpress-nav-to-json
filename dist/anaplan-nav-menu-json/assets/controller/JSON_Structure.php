<?php

    class JSON_Structure
    {
        private $menu;
      
        public function __construct($menu){
          $this->title = $menu->get_link_name();
          $this->href = $menu->get_link_value();
          $this->id = $menu->get_object_id();
        }
      
        public function get_href(){
          return $this->href;
        }

        public function get_menu_json(){
            return '{ "title": "'. $this->title .
                '", "href":"'. $this->href .
                '", "description":"' .
                '", "currentLink": "false"';
        }
      
    }
    
?>