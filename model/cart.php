<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class cart {
    public $id;
    public $customer_id;
    public $product_id;
    public $quantity;
    public $price;
    public $sub_total;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->customer_id = (int) $data->customer_id;
        $this->product_id = (int) $data->product_id;
        $this->quantity = (int) $data->quantity;
        $this->price = (int) $data->price;
        $this->sub_total = (int) $data->sub_total;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO cart (customer_id,product_id,quantity,price,sub_total) VALUES (?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iiiii', $this->customer_id,$this->product_id,$this->quantity,$this->price,$this->sub_total);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new cart : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new cart();
        $query = "SELECT id,customer_id,product_id,quantity,price,sub_total FROM cart WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one cart: ".$stmt->error;
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
        $one->customer_id = $result['customer_id'];
        $one->product_id = $result['product_id'];
        $one->quantity = $result['quantity'];
        $one->price = $result['price'];
        $one->sub_total = $result['sub_total'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$customer_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    id,customer_id,product_id,quantity,price,sub_total
                FROM 
                    cart
                WHERE
                    ".$list_query->search_by." LIKE ?
                AND
                    customer_id = ?
                ORDER BY
                    ".$list_query->order_by." ".$list_query->order_dir." 
                LIMIT ? 
                OFFSET ?";
        $stmt = $db->prepare($query);
        $search = "%".$list_query->search_value."%";
        $offset = $list_query->offset;
        $limit =  $list_query->limit;
        $stmt->bind_param('siii',$search ,$customer_id ,$limit, $offset);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query-> error = "error at query all cart : ".$stmt->error;
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
            $one = new cart();
            $one->id = $result['id'];
            $one->customer_id = $result['customer_id'];
            $one->product_id = $result['product_id'];
            $one->quantity = $result['quantity'];
            $one->price = $result['price'];
            $one->sub_total = $result['sub_total'];
            array_push($all,$one);
        }
        $result_query->data = $all;
        $stmt->close();
        return $result_query;
    }

    public function update($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "UPDATE cart SET customer_id = ?,product_id = ?,quantity = ?,price = ?,sub_total = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iiiiii', $this->customer_id,$this->product_id,$this->quantity,$this->price,$this->sub_total, $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one cart : ".$stmt->error;
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
        $query = "DELETE FROM cart WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one cart : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>