<?php

$conn = new mysqli("localhost", "root", "", "palpasa_cafe");

if(!$conn) {
    die("Connection Failled: " . mysqli_connect_error());
}

?>