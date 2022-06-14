<?php
require_once 'model/Model.php';


class Product extends Model
{

    public function addProduct($arr)
    {

        $sql_insert = "Insert into products(name,cate_id,price,image,description)
      values(:name,:cate_id,:price,:image,:description)";
        $obj_insert = $this->conn->prepare($sql_insert);
        $insert = [
            ':name' => $arr['name'],
            ':cate_id' => $arr['cate'],
            ':price' => $arr['price'],
            ':image' => $arr['image'],
            ':description' => $arr['des']
        ];
        return $obj_insert->execute($insert);
    }
    public function getAllProduct()
    {
        $sql_select = "Select*from products";
        $obj_select = $this->conn->prepare($sql_select);

        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneProduct($id)
    {
        $sql_select = "Select*from products where id=:id";
        $obj_select = $this->conn->prepare($sql_select);
        $select = [':id' => $id];
        $obj_select->execute($select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProduct($arr)
    {

        $sql_update = "Update products set name=:name,price=:price,image=:image,description=:des where id=:id";
        $obj_update = $this->conn->prepare($sql_update);
        $update = [
            ':name' => $arr['name'],
            ':price' => $arr['price'],
            ':des' => $arr['des'],
            ':image' => $arr['image'],
            ':id' => $arr['id']
        ];
        return $obj_update->execute($update);
    }
    public function delProduct($id)
    {
        $sql_del = "Delete from products where id=:id";
        $obj_del = $this->conn->prepare($sql_del);

        $del = [
            ':id' => $id
        ];
        return $obj_del->execute($del);
    }
    public function getProductLimit($str_pagination = '')
    {
        $sql_select = "Select*from products $str_pagination";
        $sql_select = $this->conn->prepare($sql_select);
        $sql_select->execute();
        return $sql_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countTotal()
    {
        $obj_select = $this->conn->prepare("SELECT COUNT(id) FROM products ");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
}
