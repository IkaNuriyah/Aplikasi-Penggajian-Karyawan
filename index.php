<?php
require 'config/config.php';

if (!$_SESSION['user']) {
    header("Location: " . urlAwal('auth/login.php'));
    exit;
} else {
    header("Location: " . urlAwal('dashboard'));
}
