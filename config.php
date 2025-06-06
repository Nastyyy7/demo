<?php
$conn = new mysqli('localhost', 'root', '', 'demo');
if($conn->connect_error){
    die(''.$conn->connect_error);
}