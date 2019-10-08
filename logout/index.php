<?php
session_start();
$_SESSION['login'] = false;
unset($_SESSION['login']);
session_destroy();
header('Location: /');
exit();
?>
