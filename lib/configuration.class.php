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
    public static $MAIL_ADDRESS_FROM = 'proginz2017@gmail.com';
    public static $MAIL_HOST = 'smtp.gmail.com';
    public static $MAIL_USERNAME = 'proginz2017@gmail.com';
    public static $MAIL_PASSWORD = 'CommonPassword';
    public static $MAIL_ENCRYPTION = 'ssl';
    public static $MAIL_PORT = '465';
    public static $MAIL_FROM= 'NEWS PIGeon';
    public static $SECRET_SIZE = '10';
    public static $ALERTS_ARRAY = ['failed-unsubscribe' => '<strong>OOOPS ! </strong> Something gone wrong. Please try again.',
                                    'successful-subscription' => '<storng>CONGRATULATIONS ! </strong> Your subscription was SUCCESSFUL',
                                    'unsubscribe-letter' => 'Confirmation email has been sent. Please follow instructions provided.',
                                    'unsubscribe-succseful' => '<strong> SUCCESS </strong> You have successfuly unsubscribed.',
                                    'bad-password' => '<strong> OOOPS ! </strong> Bad password provided.',
                                    'logged-off' => 'Admin session ended.',
                                    'login-first' => '<strong>OOOPS ! </strong> Please login first...',
                                    'successful-subscription-email' => 'Confirmation email has been sent. Please follow instructions provided.',
                                    'failed-subscribtion' => '<strong>OOOPS ! </strong> Something gone wrong. Please try again.',
                                    'no-categories-selected' => '<strong>OOOPS ! </strong> Please select category to SUBSCRIBE',
                                    'success-sending-newsletter' => '<strong> SUCCESS ! </strong> Newsletters are set for delivery.',
                                    'success-inserting-newsletter' => '<strong> SUCCESS ! </strong> Newsletter created' 
                                ];
    public static $TIME_ZONE = 'Europe/Vilnius';
    
    static function dbConnect(){
       return mysqli_connect(Configuration::$DB_SERVER, Configuration::$DB_USERNAME, Configuration::$DB_PASSWORD, Configuration::$DB_NAME);
    }
    
    static function dbDisconnect($con){
        mysqli_close($con);
    }
    
}