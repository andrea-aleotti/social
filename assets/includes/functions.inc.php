<?php

/* LOGIN VALIDATIONS*/
function checkInputsLogin($email, $psw) {
    $result = 0;
    if (empty($email) || empty($psw)) {
        $result = 1;
    }
    return $result;
}

function checkValidEmail($email) {
    $result = 1;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = 0;
    }
    return $result;
}

/* change password */
function checkInputsChangePsw($oldpsw, $newpsw, $reppsw) {
    $result = 0;
    if (empty($oldpsw) || empty($newpsw) || empty($reppsw)) {
        $result = 1;
    }
    return $result;
}

function matchPsw($psw1, $psw2) {
    $result = 1;
    if($psw1 !== $psw2) {
        $result = 0;
    }
    return $result;
}