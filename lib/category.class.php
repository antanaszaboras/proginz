<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author antan
 */
class Category {
    //put your code here
    private $id;
    private $name;
    
    public function getId(){ return $id; }
    public function getName(){ return $name; }
    
    public function setId($value){ $id = $value; }
    public function setName($value){ $name = $value; }
}
