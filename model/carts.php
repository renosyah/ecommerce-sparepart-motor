<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class carts {
    public $id;
    public $customers_id;
    public $products_id;
    public $quantity;
    public $price;
    public $sub_total;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->customers_id = (int) $data->customers_id;
        $this->products_id = (int) $data->products_id;
        $this->quantity = (int) $data->quantity;
        $this->price = (int) $data->price;
        $this->sub_total = (int) $data->sub_total;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO carts (customers_id,products_id,quantity,price,sub_total) VALUES (?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iiiii', $this->customers_id,$this->products_id,$this->quantity,$this->price,$this->sub_total);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new carts : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new carts();
        $query = "SELECT id,customers_id,products_id,quantity,price,sub_total FROM carts WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one carts: ".$stmt->error;
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
        $one->customers_id = $result['customers_id'];
        $one->products_id = $result['products_id'];
        $one->quantity = $result['quantity'];
        $one->price = $result['price'];
        $one->sub_total = $result['sub_total'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$customers_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    id,customers_id,products_id,quantity,price,sub_total
                FROM 
                    carts
                WHERE
                    ".$list_query->search_by." LIKE ?
                AND
                    customers_id = ?
                ORDER BY
                    ".$list_query->order_by." ".$list_query->order_dir." 
                LIMIT ? 
                OFFSET ?";
        $stmt = $db->prepare($query);
        $search = "%".$list_query->search_value."%";
        $offset = $list_query->offset;
        $limit =  $list_query->limit;
        $stmt->bind_param('siii',$search ,$customers_id ,$limit, $offset);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query-> error = "error at query all carts : ".$stmt->error;
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
            $one = new carts();
            $one->id = $result['id'];
            $one->customers_id = $result['customers_id'];
            $one->products_id = $result['products_id'];
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
        $query = "UPDATE carts SET customers_id = ?,products_id = ?,quantity = ?,price = ?,sub_total = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iiiiii', $this->customers_id,$this->products_id,$this->quantity,$this->price,$this->sub_total, $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one carts : ".$stmt->error;
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
        $query = "DELETE FROM carts WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one carts : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>