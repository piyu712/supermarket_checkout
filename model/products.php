<?php
/*
Created By Priyanka Patil
Description:- Product Model wherein you can fetch all the product related information.
Created On - 7th May,2022
*/
class Products {
    private $table = "Products";
    private $Connection;
    private $id;
    private $sku;
    private $price;
    private $special_price;

    public function __construct($Connection) 
    {
		$this->Connection = $Connection;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getSku() 
    {
        return $this->sku;
    }

    /*
    Created By Priyanka Patil
    Description:- Get all Product related information.
    Created On - 8th May,2022
    */
    public function getAll()
    {
        $sqlquery = $this->Connection->prepare("SELECT id,sku,price,special_price FROM " . $this->table);
        $sqlquery->execute();
        $result = $sqlquery->fetchAll();  // Fetch all of the remaining rows in the result set //
        $this->Connection = null; //close the connection.
        return $result;
    }

    /*
    Created By Priyanka Patil
    Description:- Get all Product via Id.
    Created On - 8th May,2022
    */
    public function getBy($column,$value)
    {
        $sqlquery = $this->Connection->prepare("SELECT id,sku,price,special_price FROM " . $this->table . " WHERE ".$column."='".$value."'");
        $sqlquery->execute();
        $result = $sqlquery->fetchAll(); 
        $this->Connection = null; //close the connection.
        return $result;
    }
}
?>