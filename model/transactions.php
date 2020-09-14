<?php

// menggabungkan kode dari file result_query.php
// yg mana result_query digunakan sebagai
// object yg digunakan untuk hasil
include("result_query.php");

class transactions {
    public $id;
    public $customers_id;
    public $payments_id;
    public $address;
    public $shipment_fee;
    public $total;
    public $expired_date;

    public function __construct(){
    }

    public function set($data){
        $this->id = (int) $data->id;
        $this->customers_id = (int) $data->customers_id;
        $this->payments_id = (int) $data->payments_id;
        $this->address = $data->address;
        $this->shipment_fee = (int) $data->shipment_fee;
        $this->total = (int) $data->total;
        $this->expired_date = $data->expired_date;
    }

    public function add($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "INSERT INTO transactions (customers_id,payments_id,address,shipment_fee,total,expired_date) VALUES (?,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iisiis', $this->customers_id,$this->payments_id,$this->address,$this->shipment_fee,$this->total,$this->expired_date);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error =  "error at add new transactions : ".$stmt->error;
            $result_query->data = "not ok";
        }
        $stmt->close();
        return $result_query;
    }
    
    public function one($db) {
        $result_query = new result_query();
        $one = new transactions();
        $query = "SELECT id,customers_id,payments_id,address,shipment_fee,total,expired_date FROM transactions WHERE id=? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();      
        if ($stmt->error != ""){
            $result_query-> error = "error at query one transactions: ".$stmt->error;
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
        $one->payments_id = $result['payments_id'];
        $one->address = $result['address'];
        $one->shipment_fee = $result['shipment_fee'];
        $one->total = $result['total'];
        $one->expired_date = $result['expired_date'];
        $result_query->data = $one;
        $stmt->close();
        return $result_query;
    }

    public function all($db,$list_query,$customers_id) {
        $result_query = new result_query();
        $all = array();
        $query = "SELECT 
                    id,customers_id,payments_id,address,shipment_fee,total,expired_date
                FROM 
                    transactions
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
            $result_query-> error = "error at query all transactions : ".$stmt->error;
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
            $one = new transactions();
            $one->id = $result['id'];
            $one->customers_id = $result['customers_id'];
            $one->payments_id = $result['payments_id'];
            $one->address = $result['address'];
            $one->shipment_fee = $result['shipment_fee'];
            $one->total = $result['total'];
            $one->expired_date = $result['expired_date'];
            array_push($all,$one);
        }
        $result_query->data = $all;
        $stmt->close();
        return $result_query;
    }

    public function update($db) {
        $result_query = new result_query();
        $result_query->data = "ok";
        $query = "UPDATE transactions SET customers_id = ?,payments_id = ?,address = ?,shipment_fee = ?, total = ?,expired_date = ? WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iisiisi', $this->customers_id,$this->payments_id,$this->address,$this->shipment_fee,$this->total,$this->expired_date, $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at update one transactions : ".$stmt->error;
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
        $query = "DELETE FROM transactions WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        if ($stmt->error != ""){
            $result_query->error = "error at delete one transactions : ".$stmt->error;
            $result_query->data = "not ok";
            $stmt->close();
            return $result_query;
        }
        $stmt->close();
        return $result_query;
    }
}


?>