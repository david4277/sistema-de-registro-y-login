<?php
require_once __DIR__ . '/helpers/auth.php';

if (is_logged_in()) {
    logout();
    header('location: login.php');
} else {
    header('location: login.php');
}
