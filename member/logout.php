<?php
session_start();
unset($_SESSION['operator']);
echo "<script language='javascript'>alert('kowe logout'); document.location='index.php';</script>";
?>
