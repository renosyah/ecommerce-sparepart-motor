<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class validate_transaction {
    public $id;
    public $transaction_id;
    public $image_url;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->transaction_id = (int) $data->transaction_id;
        $this->image_url = $data->image_url;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO validate_transaction (transaction_id,image_url) VALUES (?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('is',$this->transaction_id,$this->image_url);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new validate_transaction : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new validate_transaction();
        $query = "SELECT id,transaction_id,image_url FROM validate_transaction WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one validate_transaction: ".$stmt->error;
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
        $one->transaction_id= $result['transaction_id'];
        $one->image_url = $result['image_url'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$customer_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    v.id,v.transaction_id,v.image_url
                FROM 
                    validate_transaction v
                INNER JOIN
                    transaction t
                WHERE
                    ".$list_query->search_by." LIKE ?
                AND
                    t.customer_id = ?
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
            $result_query-> error = "error at query all validate_transaction : ".$stmt->error;
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
            $one = new validate_transaction();
            $one->id = $result['id'];
            $one->transaction_id= $result['transaction_id'];
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
        $query = "UPDATE validate_transaction SET transaction_id = ?,image_url = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('isi', $this->transaction_id,$this->image_url, $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one validate_transaction : ".$stmt->error;
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
        $query = "DELETE FROM validate_transaction WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one validate_transaction : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>