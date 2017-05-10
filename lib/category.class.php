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
    
    public function __construct($params = array())
    {
        $this->id = 0;
        $this->name = '';
        if($params != NULL){
            foreach ($params as $key => $value){
                $this->$key = $value;
            }
        }
    }
  
    public function addToDb(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "INSERT INTO category  "
                                        . " (name,state)  "
                                        . " VALUES ('$this->name','1')"
                    );
        Configuration::dbDisconnect($con); 
        if($result == true)
            return true;
        return false;
    }
    
    function updateInDB($categoryId){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "UPDATE category SET"
                                        . " name = '$this->name' "
                                        . " WHERE id = '$categoryId'"
                    );
        Configuration::dbDisconnect($con); 
        if($result == true)
            return true;
        return false;
    }
}
