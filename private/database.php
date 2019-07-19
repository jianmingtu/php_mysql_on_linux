<?php

require_once('db_credentials.php');

function db_connect() {
    $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
    confirm_db_connect();
    return $connection;
}

function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "database connection failed: "
            . mysqli_connect_error()
            . " ("
            . mysqli_connect_errno()
            . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set, $sql) {
    if(!$result_set) {
        global $db;
        echo $sql."<br>";
        echo mysqli_error($db);
        exit("Database query failed.");
    }
}

function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection,$string);
}

?>
