<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /WildTaste/login.html");
exit();
?>
