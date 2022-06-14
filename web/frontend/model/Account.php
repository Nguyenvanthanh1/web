<?php
require_once 'model/Model.php';
class Account extends Model
{

    public function register($arr)
    {
        $sql_insert = 'insert into user(username,password,password_confirm,image,address,date,phone)
        values(:username,:password,:password_confirm,:image,:address,:date,:phone)';
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':username' => $arr['username'],
            ':password' => $arr['password'],
            ':password_confirm' => $arr['password_confirm'],
            ':image' => $arr['image'],
            ':address' => $arr['address'],
            ':date' => $arr['date'],
            ':phone' => $arr['phone']
        ];
        return $obj_insert->execute($insert);
    }
    public function getUser($username)
    {
        $sql_select = 'select *from user where username=:username';
        $obj_select = $this->conn->prepare($sql_select);

        $select = [

            ':username' => $username
        ];

        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateResetPasswordToken($id, $password)
    {
        $sql_update = 'Update user set reset_password_token=:password where id=:id';
        $obj_update = $this->conn->prepare($sql_update);

        $update = [
            ':password' => $password,
            ':id' => $id
        ];
        return $obj_update->execute($update);
    }
    public function getUserByResetPasswordToken($hash)
    {

        $sql_select = 'Select*from user where reset_password_token=:password';
        $obj_select = $this->conn->prepare($sql_select);

        $select = [
            ':password' => $hash
        ];

        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updatePasswordReset($id, $password, $password_confirm)
    {
        $sql_update = 'Update user set password=:password,password_confirm=:password_confirm where id=:id';
        $obj_update = $this->conn->prepare($sql_update);

        $update = [
            ':password' => $password,
            ':password_confirm' => $password_confirm,
            ':id' => $id
        ];
        return $obj_update->execute($update);
    }
}
