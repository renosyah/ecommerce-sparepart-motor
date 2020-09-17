<?php

// menggabungkan kode dari file transaction.php
// yg mana model ini dibutuhkan
// untuk query
include("transaction.php");

class checkout {

    public $customer_id;
    public $payment_id;
    public $address;
    public $total;

    public function __construct(){
    }

    public function set($data){
        $this->customer_id = (int) $data->customer_id;
        $this->payment_id = (int) $data->payment_id;
        $this->address = $data->address;
        $this->total = (int) $data->total;
    }

    public function add($db,$ref_id) {
        $result_query = new result_query();

        $usr = new transaction();
        $usr->ref_id = $ref_id;
        $usr->customer_id = $this->customer_id;
        $usr->payment_id = $this->payment_id;
        $usr->address = $this->address;
        $usr->shipment_fee = 5000;
        $usr->total = $this->total;
        $usr->expired_date = date("y-m-d h:m:s",strtotime('1 hour'));
        $result = $usr->add($db);
        if ($result->error != null){
            $result_query->error = $result->error ;
            return $result_query;
        }

        $query_detail = "INSERT INTO 
            detail_transaction (
                transaction_id,
                product_id,
                quantity,
                price,
                sub_total
            ) 
            SELECT 
                (SELECT 
                    id 
                FROM 
                    transaction 
                WHERE 
                    ref_id = '$ref_id'
                LIMIT 1) AS transaction_id,
                product_id,
                quantity,
                price,
                sub_total 
            FROM 
                cart 
            WHERE 
               customer_id = $usr->customer_id";

        $stmt_detail = $db->query($query_detail);
        if (!$stmt_detail){
            $result_query->error = "error at insert to detail";
            return $result_query;
        }

        $query_cart = "DELETE FROM cart WHERE customer_id = $usr->customer_id";
        $stmt_cart = $db->query($query_cart);
        if (!$stmt_cart){
            $result_query->error = "error at delete cart";
            return $result_query;
        }
        
        $result_query->data = $ref_id;

        return $result_query;
    }

}

?>