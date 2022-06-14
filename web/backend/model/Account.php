<?php
require_once 'model/Model.php';

class Account extends Model
{


    public function register($arr)
    {
        $sql_insert = "Insert into user(username,password,password_confirm,image,date,address,phone)values
        (:name,:password,:password_confirm,:image,:date,:address,:phone)";
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':name' => $arr['name'],
            ':password' => $arr['password'],
            ':password_confirm' => $arr['password_confirm'],
            ':image' => $arr['image'],
            ':date' => $arr['date'],
            ':address' => $arr['address'],
            ':phone' => $arr['phone']
        ];

        return $obj_insert->execute($insert);
    }
    public function getUser($username)
    {
        $sql_select = "Select*from user where username=:username";
        $obj_select = $this->conn->prepare($sql_select);
        $select = [
            'username' => $username
        ];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function getAdmin($username)
    {
        $sql_select = "Select*from admin where name=:username";
        $obj_select = $this->conn->prepare($sql_select);
        $select = [
            ':username' => $username
        ];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUser()
    {
        $sql_select = "Select*from user";
        $obj_select = $this->conn->prepare($sql_select);
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserId($id)
    {
        $sql_select = "select*from user where id=:id";
        $obj_select = $this->conn->prepare($sql_select);

        $select = [
            ':id' => $id
        ];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function delUser($id)
    {
        $sql_del = "delete from user where id=:id";
        $obj_del = $this->conn->prepare($sql_del);
        $del = [
            ':id' => $id
        ];
        return $obj_del->execute($del);
    }
    public function registerAdmin($arr)
    {
        $sql_insert = "Insert into admin(name,password,password_confirm,image)values
        (:name,:password,:password_confirm,:image)";
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':name' => $arr['name'],
            ':password' => $arr['password'],
            ':password_confirm' => $arr['password_confirm'],
            ':image' => $arr['image']

        ];

        return $obj_insert->execute($insert);
    }
}
