<?php

session_start();

/**
 * @param string $name
 * @param string $message
 * @param string $class
 */
function flashMessage(string $name = '', string $message = '', string $class = 'alert alert-success')
{
    if (!empty($name)) {
        $nameClass = $name . '_class';
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$nameClass])) {
                unset($_SESSION[$nameClass]);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$nameClass] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$nameClass]) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="flash-msg">' . $_SESSION[$name] . '</div>';

            unset($_SESSION[$name]);
            unset($_SESSION[$nameClass]);
        }
    }
}
