<?php

namespace App\Model;

class UserModel extends BaseModel
{
    public function registerUser($fullName, $cpf, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (full_name, cpf, email, hashed_password) VALUES (:full_name, :cpf, :email, :hashed_password)";
        
        $this->db->query($sql, [
            ':full_name' => $fullName,
            ':cpf' => $cpf,
            ':email' => $email,
            ':hashed_password' => $hashedPassword,
        ]);
        
        // Fetch the inserted user data
        $insertedUserId = $this->db->lastInsertId();
        $userData = $this->getUser($insertedUserId);

        return $userData;
    }

    public function loginUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $result = $this->db->fetch($sql, [
            ':email' => $email,
        ]);

        // User authenticated successfully
        if ($result && password_verify($password, $result['hashed_password']))
            return $result;

        return null;
    }

    public function getUser($userId)
    {
        $sql = "SELECT * FROM users WHERE id = :user_id";
        
        $result = $this->db->fetch($sql, [
            ':user_id' => $userId,
        ]);

        return $result;
    }

    public function getUserFromEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $result = $this->db->fetch($sql, [
            ':email' => $email,
        ]);

        return $result;
    }
}