<?php
session_start();
$_SESSION["usuario_activo"]= array();
header("Location: ../../index.html");
?>