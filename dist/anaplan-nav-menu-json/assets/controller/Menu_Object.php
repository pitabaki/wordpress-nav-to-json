<?php
/*

Class to store navigation architecture

*/
class Menu_Object
{
    private $object;
    private $link_name;

    public function __construct($object, $linkname){
      $this->object = $object;
      $this->link_name = $linkname;
    }

    public function get_link_name(){
      return $this->link_name;
    }

    public function get_object(){
      return $this->object;
    }
}

?>