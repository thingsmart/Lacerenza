<?php 
session_start();
if ($_SESSION['ruolo'] != "ADMIN") {
header('Location: index.php'); 
exit();
} ?>