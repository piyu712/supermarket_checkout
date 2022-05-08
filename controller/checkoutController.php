<?php
/*
Created By Priyanka Patil
Description:- checkout class file 
Created On - 7th May,2022
*/
class CheckoutController{

    private $dbconn;
    private $Connection;

    public function __construct() 
    {
      require_once  __DIR__ . "/../core/DbConfig.php";
      require_once  __DIR__ . "/../model/checkout.php";
      require_once  __DIR__ . "/../model/products.php";

      $this->dbconn=new DbConfig();
      $this->Connection=$this->dbconn->Connection();
  }

    /*
    Created By Priyanka Patil
    Description:- Execute the corresponding action.
    Created On - 7th May,2022
    */  
    public function run($action){
        switch($action)
        { 
            case "index" :
            $this->index();
            break;
            case "add" :
            $this->create();
            break;
            case "detail" :
            $this->detail();
            break;
            case "edit" :
            $this->edit();
            break;
            case "remove" :
            $this->remove();
            break;
            default:
            $this->index();
            break;
        }
    }
    
    /*
    Created By Priyanka Patil
    Description:- Loads the product page with the list of products fetched from the model.
    Created On - 7th May,2022
    */ 
    public function index()
    {

        $checkout=new Checkout($this->Connection);
        $checkout=$checkout->getAll();
        $product=new Products($this->Connection);
        $products=$product->getAll();
        //We load the index view and pass values to it
        $this->view("index",array(
            "checkout"=>$checkout,
            "products" => $products
        ));
    }


    /*
    Created By Priyanka Patil
    Description:- Get product detail via models.
    Created On - 8th May,2022
    */ 
    public function detail(){
        $model = new Checkout($this->Connection); //initiate the model.
        $checkout = $model->getById($_GET["id"]);
        $product=new Products($this->Connection);
        $products=$product->getAll();
        $this->view("detail",array(
            "checkout"=>$checkout,
            "products" => $products
        ));
    }


    /*
    Created By Priyanka Patil
    Description:- Remove products from cart page.
    Created On - 8th May,2022
    */ 
    public function remove(){

        $model = new Checkout($this->Connection); //initiate the model.
        $checkout = $model->deleteById($_GET["id"]); //load the detail view and pass values to it .
        header('Location: index.php');
    }

    /*
    Created By Priyanka Patil
    Description:- Add Products to the cart take post params and reload the index page .
    Created On - 8th May,2022
    */ 
    public function create(){
        if(isset($_POST["Name"]))
        {
            $product=new Products($this->Connection);
            $selected_product=$product->getBy("sku",$_POST["Name"]);

            if($selected_product[0]['special_price'] != "")
            {
                $special_price_array = json_decode($selected_product[0]['special_price'], true);

                foreach($special_price_array as $special_prices) 
                {
                    if($_POST["Quantity"] == $special_prices['qty'])
                    {
                        $og_price = $selected_product[0]['price']*$_POST["Quantity"];
                        $special_price = $special_prices['price'];
                        $price=$og_price-$special_price;
                        break;

                    }
                    else
                    {
                        $price=0;
                        $special_price = $selected_product[0]['price']*$_POST["Quantity"];
                    }
                }
            }
            else
            {
                $price=0;
                $special_price = $selected_product[0]['price']*$_POST["Quantity"];
            }
            
            $checkout=new Checkout($this->Connection);
            $checkout->setSku($_POST["Name"]);
            $checkout->setQuantity($_POST["Quantity"]);
            $checkout->setOriginalPrice($selected_product[0]['price']);
            $checkout->setPrice($price);
            $checkout->setFinalPrice($special_price);
            $save=$checkout->save();
        }
        header('Location: index.php');
    }

    /*
    Created By Priyanka Patil
    Description:- update Products to the cart take post params and reload the index page .
    Created On - 8th May,2022
    */ 
    public function edit(){
        if(isset($_POST["id"])){


            $product=new Products($this->Connection);
            $selected_product=$product->getBy("sku",$_POST["Name"]); //fetch all products.

            if($selected_product[0]['special_price'] != "")
            {
                $special_price_array = json_decode($selected_product[0]['special_price'], true);

                foreach($special_price_array as $special_prices) 
                {
                    if($_POST["Quantity"] == $special_prices['qty'])
                    {
                        $og_price = $selected_product[0]['price']*$_POST["Quantity"];
                        $special_price = $special_prices['price'];
                        $price=$og_price-$special_price;
                        break;

                    }
                    else
                    {
                        $price=0;
                        $special_price = $selected_product[0]['price']*$_POST["Quantity"];
                    }
                }
            }
            else
            {
                $price=0;
                $special_price = $selected_product[0]['price']*$_POST["Quantity"];
            }
            $checkout=new Checkout($this->Connection);
            $checkout->setId($_POST["id"]);
            $checkout->setSku($_POST["Name"]);
            $checkout->setQuantity($_POST["Quantity"]);
            $checkout->setOriginalPrice($selected_product[0]['price']);
            $checkout->setPrice($price);
            $checkout->setFinalPrice($special_price);
            $save=$checkout->update();
        }
        header('Location: index.php');
    }
    

   /*
    Created By Priyanka Patil
    Description:-create view html pages here and pass it on to the corresponding page .
    Created On - 8th May,2022
    */ 
    public function view($vista,$data){
        $data = $data;  
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }

}
?>