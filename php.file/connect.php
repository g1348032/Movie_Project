<?php
$username = "root";
$password = "Araiharuka0207@";
$conn = new PDO('mysql:host=127.0.0.1;dbname=Movies_DVDs', $username, $password);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>