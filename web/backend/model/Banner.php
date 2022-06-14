<?php
require_once 'model/Model.php';


class Banner extends Model
{

    public function addBanner($arr)
    {

        $sql_insert = "Insert into banner(name,image,date)
        values(:name,:image,:date)";
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':name' => $arr['name'],
            ':image' => $arr['image'],
            ':date' => $arr['date']
        ];
        return $obj_insert->execute($insert);
    }
    public function showBanner($str_pagination = '')
    {
        $sql_select = "Select*from banner $str_pagination ";

        $obj_select = $this->conn->prepare($sql_select);

        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBanner($id)
    {
        $sql_select = "Select*from banner where id=:id";
        $obj_select = $this->conn->prepare($sql_select);

        $select = ['id' => $id];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateBanner($arr)
    {
        $sql_update = 'Update banner set name=:name,image=:image,date=:date where id=:id';
        $obj_update = $this->conn->prepare($sql_update);

        $update = [
            ':id' => $arr['id'],
            ':name' => $arr['name'],
            ':image' => $arr['image'],
            ':date' => $arr['date']
        ];
        return $obj_update->execute($update);
    }
    public function delBanner($id)
    {
        $sql_del = "delete from banner where id=:id";
        $obj_del = $this->conn->prepare($sql_del);

        $del = [':id' => $id];
        return $obj_del->execute($del);
    }
    public function countTotal()
    {
        $obj_select = $this->conn->prepare("SELECT COUNT(id) FROM banner ");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }
}
