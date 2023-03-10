<?php
session_start();

session_destroy();
setcookie('login', '', time() - 60);
header('Location: index.php');
exit;
