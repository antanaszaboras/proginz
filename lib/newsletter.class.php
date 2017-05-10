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
        if($params != NULL){
            foreach ($params as $key => $value){
                $this->$key = $value;
            }
        }
        
    }
  
    public function addToDb(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "INSERT INTO newsletter  "
                                        . " (date,name,description,category,body,state)  "
                                        . " VALUES ('$this->date','$this->name','$this->description','$this->category','$this->body','3')"
                    );
        Configuration::dbDisconnect($con); 
        if($result == true)
            return true;
        return false;
    }
    
    function updateInDB($nlid){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "UPDATE newsletter SET"
                                        . " date = '$this->date', "
                                        . " name = '$this->name', "
                                        . " description = '$this->description', "
                                        . " category = '$this->category', "
                                        . " body = '$this->body' "
                                        . " WHERE id= '$nlid'"
                    );
        Configuration::dbDisconnect($con); 
        if($result == true)
            return true;
        return false;
    }
}
