<?php
include('../../connection/PHPpdo.php');
include('../../config.php');
if(!isset($_SESSION['user'])){
    header('Location:http://'.SERVERROOT);
}