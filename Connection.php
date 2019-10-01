<?php
namespace app;
use mysqli;


abstract class Connection {
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'test_kit';

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
    abstract protected function result_login_sql($login);
    abstract public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id);
    abstract public function check_log_pass_sql($login,$password);
    public function query($sql) {
        return $this->connection->query($sql);
    }
}
class User extends Connection {
    private $table = '`users`';

    public function result_login_sql($login)
    {
        $result_log = "SELECT * FROM $this->table WHERE login = '$login'";
        return $result_log;
    }

    public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id)
    {
        $add = "INSERT INTO $this->table (login,password,name,surname,birth_date,email,tel,registration_date,role_id) VALUES ('$login','$password','$name','$surname','$birth_date','$email','$phone','$today','$role_id')";
        parent::query($add);
        return $add;
    }

    public function check_log_pass_sql($login,$password)
    {
        $result_log_pass = "SELECT * FROM $this->table WHERE login = '$login' AND password = '$password'";
        return $result_log_pass;
    }
//    public function getAll() {
//        $result = parent::query("SELECT * FROM $this->table");
//        $row_auth = $result->fetch_assoc;
//        return $row_auth;
//  }
}
