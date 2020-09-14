<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class products {
    public $id;
    public $categories_id;
    public $name;
    public $price;
    public $stock;
    public $rating;
    public $image_url;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->categories_id = (int) $data->categories_id;
        $this->name = $data->name;
        $this->price = (int) $data->price;
        $this->stock = (int) $data->stock;
        $this->rating = (int) $data->rating;
        $this->image_url = $data->image_url;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO products (name,categories_id,price,stock,rating,image_url) VALUES (?,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('siiiis', $this->name, $this->categories_id, $this->price, $this->stock, $this->rating, $this->image_url);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new products : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new products();
        $query = "SELECT id,name,categories_id,price,stock,rating,image_url FROM products WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one products: ".$stmt->error;
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
        $one->categories_id = $result['categories_id'];
        $one->name = $result['name'];
        $one->price = $result['price'];
        $one->stock = $result['stock'];
        $one->rating = $result['rating'];
        $one->image_url = $result['image_url'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$categories_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    id,name,categories_id,price,stock,rating,image_url
                FROM 
                    products
                WHERE
                    ".$list_query->search_by." LIKE ?
                AND
                    categories_id = ?
                ORDER BY
                    ".$list_query->order_by." ".$list_query->order_dir." 
                LIMIT ? 
                OFFSET ?";
        $stmt = $db->prepare($query);
        $search = "%".$list_query->search_value."%";
        $offset = $list_query->offset;
        $limit =  $list_query->limit;
        $stmt->bind_param('siii',$search ,$categories_id ,$limit, $offset);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query-> error = "error at query all products : ".$stmt->error;
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
            $one = new products();
            $one->id = $result['id'];
            $one->categories_id = $result['categories_id'];
            $one->name = $result['name'];
            $one->price = $result['price'];
            $one->stock = $result['stock'];
            $one->rating = $result['rating'];
            $one->image_url = $result['image_url'];
            array_push($all,$one);
        }
        $result_query->data = $all;
        $stmt->close();
        return $result_query;
    }

    public function update($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "UPDATE products SET name = ?,categories_id = ?,price = ?,stock = ?,rating = ?,image_url = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('siiiisi', $this->name,$this->categories_id,$this->price,$this->stock,$this->rating,$this->image_url,$this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one products : ".$stmt->error;
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
        $query = "DELETE FROM products WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one products : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>