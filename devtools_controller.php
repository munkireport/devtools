<?php

/**
 * Devtools module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Devtools_controller extends Module_controller
{
    /*** Protect methods with auth! ****/
    function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
    * Default method
    * @author tuxudo
    *
    **/
    function index()
    {
        echo "You've loaded the devtools module!";
    }

    /**
    * Retrieve data in json format
    *
    **/
    public function get_data($serial_number = '')
    {
        $devtools = new Devtools_model($serial_number);
        jsonView($devtools->rs);
    }
} // End class Devtools_controller
