<?php
session_start();
require "../app/Connection.php";
use app\User;

$connection = new User();
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$login = trim($_POST['login']);
$today = date("m.d.y");
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$birth_date = trim($_POST['date']);
$role_id = 1;

$result_login = $connection->result_login_sql($login);
$num_log = $result_login->num_rows;
if($num_log == 0) {
    if ($connection->add_user_sql($login, $password, $name, $surname, $birth_date, $email, $phone, $today, $role_id)) {
        $result_pass_login = $connection->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");
        $row_auth = $result_pass_login->fetch_assoc();
        $_SESSION['user'] = array($row_auth['id'], $row_auth['login'], $row_auth['password'], $row_auth['name'], $row_auth['surname'], $row_auth['birth_date'], $row_auth['email'], $row_auth['tel'], $row_auth['registration_date'], $row_auth['role_id']);
        header('Location: ../resources/views/account/hub-test.php');
    } else {
        header('Location: /');
    }
}
