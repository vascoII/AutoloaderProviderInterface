<?php
namespace YYY\Service;

class MyServiceYYY
{
    private static $_instance = null;

    private function __construct() 
    {
        
    }
   
    public static function getInstance() 
    {
        if(is_null(self::$_instance)) :
            self::$_instance = new MyServiceYYY();
        endif;
        return self::$_instance;
    }
    
}
