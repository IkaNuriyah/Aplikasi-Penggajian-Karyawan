<?php
require '../config/config.php';
session_start();
$_SESSION = [];
session_unset();
session_destroy();
header("Location: " . urlAwal('auth/login.php'));
exit;
