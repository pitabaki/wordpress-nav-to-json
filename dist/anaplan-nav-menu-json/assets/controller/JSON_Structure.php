<?php

    class JSON_Structure
    {
        private $menu;
      
        public function __construct($menu){
          $this->title = $menu->get_link_name();
          $this->href = $menu->get_link_value();
        }
      
        public function get_href(){
          return $this->href;
        }

        public function get_menu_json(){
            $title = ( strlen($this->title) > 0 ) ? $this->title:"";
            $href = ( strlen($this->href) > 0 ) ? $this->href:"";
            return '{ "title": "'. $title .
                '", "href":"'. $href .
                '", "description":"' .
                '", "currentLink": "false"';
        }
      
    }
    
?>