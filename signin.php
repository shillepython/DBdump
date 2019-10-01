<?php
session_start();
require "../app/Connection.php";
use app\User;

$connection = new User();
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$result_pass_login = $connection->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");
$row_auth = $result_pass_login->fetch_assoc();
$num = $result_pass_login->num_rows;
if($num == 1) {
    $result_pass_login = $connection->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");
    $row_auth = $result_pass_login->fetch_assoc();
    $_SESSION['user'] = array($row_auth['id'], $row_auth['login'], $row_auth['password'], $row_auth['name'], $row_auth['surname'], $row_auth['birth_date'], $row_auth['email'], $row_auth['tel'], $row_auth['registration_date'], $row_auth['role_id']);
    header('Location: ../resources/views/account/hub-test.php');
} else{
    echo 'fatal';
}