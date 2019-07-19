<?php

    session_start();

    // assign file paths to PHP constants
    // __FILE__ returns the current path to this file
    // dirname() returns the path to the parent directory
    define("PRIVATE_PATH",  dirname(__FILE__));
    define("PROJECT_PATH",  dirname(PRIVATE_PATH));
    define("PUBLIC_PATH",  PROJECT_PATH.'/public');
    define("SHARED_PATH",  PRIVATE_PATH.'/shared');

    //assign the root URL to a pHP constant
    // do not ned to include the domain
    // use same document toot as webserver
    // can set a dynamic urL:
    // $_SERVER[SCRIPT_NAME] => /global_bank/public/staff/index.php
    // $doc_root => /global_bank/public
    // www_ROOT => /global_bank/public
    $public_end = strpos($_SERVER['SCRIPT_NAME'],'/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'],0, $public_end);
    define("WWW_ROOT",  $doc_root);

    require_once('functions.php');
    require_once('validation_functions.php');
    require_once ('database.php');
    require_once('query_functions.php');

    $errors = [];

    $db = db_connect();
?>
