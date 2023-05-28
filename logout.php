<?php
require_once __DIR__ . '/helpers/auth.php';

// Cerrar la sesion y reedirigir al login
logout();
header('location: login.php');
