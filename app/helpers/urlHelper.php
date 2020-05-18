<?php

/**
 * @param $page
 */
function redirectPage(string $page)
{
    header('location: ' . URL_ROOT . '/' . $page);
}
