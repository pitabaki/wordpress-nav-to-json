<?php
/*

Class to store navigation architecture

*/
class Menu_Item
{
  private $object;
  private $object_id;
  private $link_name;
  private $link_value;
  private $classes;

  public function __construct($object, $object_id, $linkname, $linkvalue, $classvalue){
    $this->object_id = $object_id;
    $this->object = $object;
    $this->link_name = $linkname;
    $this->link_value = $linkvalue;
    $this->classes = $classvalue;
  }

  public function get_link_name(){
    return $this->link_name;
  }

  public function get_object_id(){
    return $this->object_id;
  }

  public function get_link_value(){
    return $this->link_value;
  }

  public function get_object(){
    return $this->object;
  }
  
  public function get_classes(){
    return $this->classes;
  }

}

?>