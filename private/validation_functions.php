<?php
    function is_blank($value) {
        return (!isset($value) || trim($value)==="");
    }

    function has_present($value) {
        return !is_blank($value);
    }

    function has_length_greater_than($value, $min) {
        return (has_present($value) && strlen($value) > $min);
    }

    function has_length_less_than($value, $max) {
        return (has_present($value) && strlen($value) < $max);
    }

    function has_length_exact($value, $exact) {
        return (has_present($value) && strlen($value) === $exact);
    }

    function has_length($value, $options) {
        if((isset($options['min']) && has_length_less_than($value, $options['min'])) ||
            (isset($options['max']) && has_length_greater_than($value, $options['min'])) ||
            (isset($options['exact']) && !has_length_exact($value,$options['exact']))) {
            return false;
        }

        return true;
    }

    function has_include_of($value, $set) {
        return in_array($value, $set);
    }

    function has_exclude_of($value, $set) {
        return !in_array($value, $set);
    }

    function has_string($value, $string) {
        return strpos($value, $string) !== false;
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

