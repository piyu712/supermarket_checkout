<?php
/*
Created By Priyanka Patil
Description:- Checkout Model.
Created On - 7th May,2022
*/
class Checkout {
    private $table = "Checkout";
    private $Connection;
    private $id;
    private $sku;
    private $quantity;
    private $price;
    private $original_price;
    private $final_price;

    public function __construct($Connection) {
      $this->Connection = $Connection;
  }

public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

public function getSku() {
    return $this->sku;
}

public function setSku($sku) {
    $this->sku = $sku;
}

public function getQuantity() {
    return $this->quantity;
}

public function setQuantity($quantity) {
    $this->quantity = $quantity;
}

public function getPrice() {
    return $this->price;
}

public function setPrice($price) {
    $this->price = $price;
}

public function getFinalPrice() {
    return $this->final_price;
}

public function setFinalPrice($final_price) {
    $this->final_price = $final_price;
}

public function getOriginalPrice() {
    return $this->original_price;
}

public function setOriginalPrice($original_price) {
    $this->original_price = $original_price;
}

    /*
    Created By Priyanka Patil
    Description:- Save the checkout data  into db.
    Created On - 7th May,2022
    */
    public function save()
    {
        $sqlquery = $this->Connection->prepare("INSERT INTO " . $this->table . " (sku,quantity,price,original_price,final_price)
            VALUES ('".$this->sku."',".$this->quantity.",".$this->price.",".$this->original_price.",".$this->final_price.")");
        $result = $sqlquery->execute();
        $this->Connection = null; //close the connection.
        return $result;
    }

    /*
    Created By Priyanka Patil
    Description:- update the checkout data into db.
    Created On - 7th May,2022
    */
    public function update()
    {
        $sqlquery = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
            sku = :sku,
            quantity = :quantity, 
            price = :price,
            original_price = :original_price,
            final_price = :final_price
            WHERE id = :id 
            ");

        $result = $sqlquery->execute(array(
            "id" => $this->id,
            "sku" => $this->sku,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "original_price" => $this->original_price,
            "final_price" => $this->final_price
        ));
        $this->Connection = null; //close the connection.
        return $result;
    }

    /*
    Created By Priyanka Patil
    Description:- get all data .
    Created On - 7th May,2022
    */
    public function getAll()
    {
        $sqlquery = $this->Connection->prepare("SELECT id,sku,quantity,price,original_price,final_price FROM " . $this->table);
        $sqlquery->execute();
        $results = $sqlquery->fetchAll();
        $this->Connection = null; //close the connection.
        return $results;

    }
    
    public function getById($id){
        $sqlquery = $this->Connection->prepare("SELECT id,sku,quantity,price,original_price,final_price 
            FROM " . $this->table . "  WHERE id = :id");
        $sqlquery->execute(array(
            "id" => $id
        ));
        $result = $sqlquery->fetchObject();
        $this->Connection = null; //close the connection.
        return $result;
    }
    
    public function getBy($column,$value){
        $sqlquery = $this->Connection->prepare("SELECT id,sku,quantity,price 
            FROM " . $this->table . " WHERE :column = :value");
        $sqlquery->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $results = $sqlquery->fetchAll();
        $this->Connection = null; //close the connection.
        return $results;
    }
    
    public function deleteById($id){
        try {
            $sqlquery = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $sqlquery->execute(array(
                "id" => $id
            ));
            $Connection = null; //close the connection.
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
    
    public function deleteBy($column,$value){
        try {
            $sqlquery = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $sqlquery->execute(array(
                "column" => $value,
                "value" => $value,
            ));
            $Connection = null; //close the connection.
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
    
}
?>