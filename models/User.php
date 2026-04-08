<?php 
class User{
private $db;
public function __construct() { $this->db = Database::connect(); }

private $id ;
private $username;
private $email;
private $password;

public function register($username,$email,$password){

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt =  $this->db->prepare("INSERT INTO USERS (username,email,password_hash)VALUES(?,?,?)");
    return $stmt->execute([htmlspecialchars($username),filter_var($email, FILTER_SANITIZE_EMAIL),$hash]);
}
public function login($email, $password) {

    $user = $this->findByEmail($email);

    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    }
    return false;
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }

}


?>