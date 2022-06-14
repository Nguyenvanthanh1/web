<?php

require_once 'model/Model.php';

class Category extends Model
{

    public function create($name)
    {

        $sql_insert = "Insert into categories(name)values(:name)";
        $obj_insert = $this->conn->prepare($sql_insert);

        $insert = [
            ':name' => $name
        ];
        return $obj_insert->execute($insert);
    }

    public function getAllCate($str_pagination = '')
    {
        $sql_select = "Select*from categories $str_pagination";

        $obj_select = $this->conn->prepare($sql_select);
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneCate($id)
    {
        $sql_select = "Select *from categories where cate_id=:cate_id";
        $obj_select = $this->conn->prepare($sql_select);
        $select = [
            ':cate_id' => $id
        ];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateCate($arr)
    {

        $sql_update = "Update categories set name=:name where cate_id=:id";
        $obj_update = $this->conn->prepare($sql_update);
        $update = [
            ':id' => $arr['id'],
            ':name' => $arr['name']
        ];
        return $obj_update->execute($update);
    }
    public function delCate($cate_id)
    {
        $sql_del = "Delete from categories where cate_id=:cate_id";
        $obj_del = $this->conn->prepare($sql_del);
        $del = [
            ':cate_id' => $cate_id
        ];
        return $obj_del->execute($del);
    }
    public function countTotal()
    {
        $obj_select = $this->conn->prepare("SELECT COUNT(cate_id) FROM categories ");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
}
