<?php
class UserModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function login($username, $password){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        $hashed_password = $row->password ?? ''; // Handle if row is false

        if($row && password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
