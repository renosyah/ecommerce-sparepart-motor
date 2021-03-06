<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class product {
    public $id;
    public $category_id;
    public $name;
    public $price;
    public $stock;
    public $rating;
    public $image_url;
    public $detail;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->category_id = (int) $data->category_id;
        $this->name = $data->name;
        $this->price = (int) $data->price;
        $this->stock = (int) $data->stock;
        $this->rating = (int) $data->rating;
        $this->image_url = $data->image_url;
        $this->detail = $data->detail;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO product (name,category_id,price,stock,rating,image_url,detail) VALUES (?,?,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('siiiiss', $this->name, $this->category_id, $this->price, $this->stock, $this->rating, $this->image_url, $this->detail);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new product : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new product();
        $query = "SELECT id,name,category_id,price,stock,rating,image_url,detail FROM product WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one product: ".$stmt->error;
            $stmt->close();
            return $result_query;
        }
        $rows = $stmt->get_result();
        if($rows->num_rows == 0){
            $stmt->close();
            return $result_query;
        }
        $result = $rows->fetch_assoc();
        $one->id = $result['id'];
        $one->category_id = $result['category_id'];
        $one->name = $result['name'];
        $one->price = $result['price'];
        $one->stock = $result['stock'];
        $one->rating = $result['rating'];
        $one->image_url = $result['image_url'];
        $one->detail = $result['detail'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$category_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    id,name,category_id,price,stock,rating,image_url,detail
                FROM 
                    product
                WHERE
                    ".$list_query->search_by." LIKE ?
                AND
                    category_id = ?
                ORDER BY
                    ".$list_query->order_by." ".$list_query->order_dir." 
                LIMIT ? 
                OFFSET ?";
        $stmt = $db->prepare($query);
        $search = "%".$list_query->search_value."%";
        $offset = $list_query->offset;
        $limit =  $list_query->limit;
        $stmt->bind_param('siii',$search ,$category_id ,$limit, $offset);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query-> error = "error at query all product : ".$stmt->error;
            $stmt->close();
            return $result_query;
        }
        $rows = $stmt->get_result();
        if($rows->num_rows == 0){
            $stmt->close();
            $result_query->data = $all;
            return $result_query;
        }

        while ($result = $rows->fetch_assoc()){
            $one = new product();
            $one->id = $result['id'];
            $one->category_id = $result['category_id'];
            $one->name = $result['name'];
            $one->price = $result['price'];
            $one->stock = $result['stock'];
            $one->rating = $result['rating'];
            $one->image_url = $result['image_url'];
            $one->detail = $result['detail'];
            array_push($all,$one);
        }
        $result_query->data = $all;
        $stmt->close();
        return $result_query;
    }

    public function update($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "UPDATE product SET name = ?,category_id = ?,price = ?,stock = ?,rating = ?,image_url = ?,detail = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('siiiissi', $this->name,$this->category_id,$this->price,$this->stock,$this->rating,$this->image_url,$this->detail,$this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one product : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
    
    public function delete($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "DELETE FROM product WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one product : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>