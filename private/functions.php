<?php

function url_for($script_path) {
    if($script_path[0] != '/') {
        $script_path = "/".$script_path;

    }
    return WWW_ROOT.$script_path;
}

function h($string) {
    return htmlspecialchars($string);
}

function u($string) {
    return urlencode($string);
}

function error_404() {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    exit();
}

function error_500() {
    header($_SERVER['SERVER_PROTOCOL']." 500 Not Found");
    exit();
}

function redirect_to($string) {
    header("Location: $string");
}

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_error($errors) {
    $display = "";
    if(!empty($errors)) {
        $display = "<div class = \"errors\">";
        foreach ($errors as $error) {
            $display .= "<p class=\"error\"> $error </p>";
        }
        $display .= "</div>";
    }

    return $display;
}

function get_and_clear_session_message() {
    if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
    }
}

function display_session_message() {
    $msg = get_and_clear_session_message();
    if(!is_blank($msg)) {
        return '<div id="message">' . h($msg) . '</div>';
    }
}