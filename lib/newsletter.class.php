<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newsletter
 *
 * @author antan
 */
class Newsletter {
    //put your code here
    private $id;
    private $date;
    private $category;
    private $description;
    private $body;
    
    public function getId(){ return $this->id; }
    public function getDate(){ return $this->date; }
    public function getCategory(){ return $this->category; }
    public function getDescription(){ return $this->description; }
    public function getBody(){ return $this->body; }

    
    public function setId($value){ $this->id = $value; }
    public function setDate($value){ $this->date = $value; }
    public function setCategory($value){ $this->category = $value; }
    public function setDescription($value){ $this->description = $value; }
    public function setBody($value){ $body = $this->value; }
    
    public function printItem(){
        echo $this->id . ' ' . $this->date . ' ' . $this->category . ' ' . $this->description . ' ' . $this->body;
    }
    
    public function getItemFromDB($itemId){
        
    }
    
}
