<?php
/**
 * @param string $formName
 * @return string
 */
function generateCSRFToken(string $formName) : string
{
    $secretKey = SECRET_KEY_CSRF;

    if (!session_id()) {
        session_start();
    }

    $sessionId =  session_id();

    return sha1($formName . $sessionId . $secretKey);

}

/**
 * @param string $token
 * @param string $formName
 * @return bool
 */
function checkCSRFToken(string $token, string $formName) : bool
{
    return $token === generateCSRFToken($formName);
}
