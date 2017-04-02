<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printAllNewsletters(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "INSERT INTO newsletters (state, date, category, description, body) VALUES ('1','$this->date','$this->category','$this->description','$this->body')") or die(mysqli_error($con));
    
}