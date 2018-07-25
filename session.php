<?php
session_start();
if(!isset($_SESSION['id_admin'])){
header("Location:index.html?page=".base64_encode($_SERVER["REQUEST_URI"]));
}
?>
