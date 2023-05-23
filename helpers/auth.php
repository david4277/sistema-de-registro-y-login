<?php

session_start();

function is_logged_in(): bool
{
    return isset($_SESSION['login']);
}

function login(int $user_id): void
{
    $_SESSION['user_id'] = $user_id;
    $_SESSION['login'] = true;
}

function logout()
{
    $_SESSION = [];
    session_destroy();
}

function error_login():void{
    $_SESSION['message'] = [
        'type' => 'danger',
        'content' => 'Email o contraseña incorrectos'
    ];
}