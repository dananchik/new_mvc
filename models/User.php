<?php


namespace models;

use brain\Model;
use Exception;

class User extends Model
{
    public function selectAll()
    {
        $sql = 'SELECT * from users';
        try {
            return $this->db->querySelect($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function addUser($params)
    {
        $sql = 'INSERT INTO users (firstname, lastname, mydate, country, phone, email, subject) VALUES (:firstname, :lastname, :mydate, :country, :phone, :email, :subject)';
        return $this->db->query($sql, $params); //нужно передать параметры
    }
    public function updateUser($params){
        $sql= 'UPDATE users  SET company = :company, position = :position, aboutme = :aboutme, photo = :photo  WHERE email = :email';
        return $this->db->query($sql,$params);
    }
    public function checkEmailUniq($email)
    {
        $sql = 'SELECT email from users where email=:email';
        return $this->db->querySelect($sql,['email'=>$email]);
    }
}