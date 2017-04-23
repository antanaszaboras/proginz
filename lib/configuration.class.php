<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuration
 *
 * @author antan
 */
class Configuration {
    public static $DB_SERVER   = 'localhost';
    public static $DB_NAME     = 'newsletters';
    public static $DB_USERNAME = 'root';
    public static $DB_PASSWORD = '';
    public static $ADMIN_PASSWORD = 'admin';
    public static $BOOL_VISUAL = ['3' => 'READY', '2' => 'SENT', '-1' => 'DELETED', '1' => 'ACTIVE', '0' => 'DISABLED'];
    
    static function dbConnect(){
       return mysqli_connect(Configuration::$DB_SERVER, Configuration::$DB_USERNAME, Configuration::$DB_PASSWORD, Configuration::$DB_NAME);
    }
    
    static function dbDisconnect($con){
        mysqli_close($con);
    }
}