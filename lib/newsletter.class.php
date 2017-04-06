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
    private $name;
    private $date;
    private $category;
    private $description;
    private $body;
    
    public function __construct($params = array())
    {
        $this->id = 0;
        $this->name = '';
        $this->category = new Category();
        $this->description = '';
        $this->body = '';
        foreach ($params as $key => $value){
            $this->$key = $value;
        }
        
    }
    
    public function getId(){ return $this->id; }
    public function getName(){ return $this->name; }
    public function getDate(){ return $this->date; }
    public function getCategory(){ return $this->category; }
    public function getDescription(){ return $this->description; }
    public function getBody(){ return $this->body; }

    public function setId($value){ $this->id = $value; }
    public function setName($value){ $this->name = $value; }
    public function setDate($value){ $this->date = $value; }
    public function setCategory($value){ $this->category = $value; }
    public function setDescription($value){ $this->description = $value; }
    public function setBody($value){ $this->body = $value; }
    
    public function setItem($id, $date, $category, $description, $body){
        $this->id = $id;
        $this->date = $date;
        $this->category = $category;
        $this->description = $description;
        $this->body = $body;
    }
    
    public function printItem(){
        echo $this->id . ' ' . $this->name . $this->date . ' ' . $this->category->getName() . ' ' . $this->description . ' ' . $this->body;
    }
    
    public function getItemFromDB($itemId){
        
    }
    
    public function insertItemToDB(){
        $con = Configuration::dbConnect();
        mysqli_query($con, "INSERT INTO newsletter (state, date, category, description, body) VALUES ('1','$this->date','$this->category','$this->description','$this->body')") or die(mysqli_error($con));
        Configuration::dbDisconnect($con);
        
    }
}
