<?php
require_once 'model/Model.php';


class Post extends Model
{


    public function addNew($arr)
    {
        $sql_insert = "Insert into news(name,date,image,description)values(:name,:date,:image,:des)";
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':name' => $arr['name'],
            ':date' => $arr['date'],
            ':image' => $arr['image'],
            ':des' => $arr['des']
        ];
        return $obj_insert->execute($insert);
    }
    public function getAllNew($str_pagination = '')
    {

        $sql_select = "Select*from news $str_pagination";
        $obj_select = $this->conn->prepare($sql_select);

        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneNew($id)
    {
        $sql_select = "Select *from news where id=:id";
        $obj_select = $this->conn->prepare($sql_select);
        $insert = [
            ':id' => $id
        ];
        $obj_select->execute($insert);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateNew($arr)
    {
        $sql_update = "Update news set name=:name,date=:date,image=:image,description=:des where id=:id";
        $obj_update = $this->conn->prepare($sql_update);

        $update = [
            ':name' => $arr['name'],
            ':date' => $arr['date'],
            ':image' => $arr['image'],
            ':des' => $arr['des'],
            ':id' => $arr['id']
        ];
        return $obj_update->execute($update);
    }
    public function delNew($id)
    {
        $sql_delete = "Delete from news where id=:id";
        $obj_delete = $this->conn->prepare($sql_delete);

        $del = [
            ':id' => $id
        ];

        return $obj_delete->execute($del);
    }
    public function countTotal()
    {
        $obj_select = $this->conn->prepare("SELECT COUNT(id) FROM news ");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
}
