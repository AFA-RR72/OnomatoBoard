<?php session_start();

$_SESSION = [];
session_destroy();
session_abort();

header('Location: ../view/login.php');

?>