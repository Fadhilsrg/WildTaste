<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /UASWeb/WildTaste/login.html");
exit();
?>
