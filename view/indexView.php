<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Supermarket checkout</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        input{
            margin-top:5px;
            margin-bottom:5px;
        }
        .right{
            float:right;
        }
    </style>
</head>
<body>
    

    <div class="col-lg-12">
        <h3>Products</h3>
        <hr/>
        <section class="col-lg-12" style="height:200px;overflow-y:scroll;">
            <?php foreach($data['products'] as $product) {?>
            Product: <b><?php echo $product["sku"]; ?></b>, Price: <b><?php echo $product["price"]; ?> Rs</b>, 
            
            <?php
                if($product['special_price'] != "")
                {
                ?>
                Special Price: 
                <?php
                }
            ?>

            <?php 
                $special_price_array = json_decode($product['special_price'], true);
                
                foreach($special_price_array as $special_prices) 
                {
                    if(isset($special_prices['product']))
                    {
                    ?>
                    Buy at <b><?=$special_prices['price']?> Rs</b> with <b><?=$special_prices['product']?></b>,
                    <?php
                    }
                    else
                    {
                    ?>
                    Buy <b><?=$special_prices['qty']?></b> at <b><?=$special_prices['price']?> Rs</b>, 
                    <?php 
                    }
                }
            ?>
            <hr/>
            <?php } ?>
        </section>

    </div>

    <form action="index.php?controller=checkout&action=add" method="post" class="col-lg-5">
        <h3>Add Product</h3>
        <hr/>
        Product: <select name="Name" class="form-control">
            <?php 
                foreach($data['products'] as $product) {?>
                <option value="<?php echo $product['sku']; ?>">
                    <?php echo $product['sku']; ?>
                </option>
                <?php } ?>
            </select>
            Quantity: <input type="text" autocomplete="off" name="Quantity" class="form-control"/>
            <input type="submit" value="Add to cart" class="btn btn-success"/>
        </form>
        
        <div class="col-lg-7">
            <h3>Checkout</h3>
            <hr/>
        </div>
        <section class="col-lg-7 " style="height:400px;overflow-y:scroll;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($data["checkout"] as $product) {?>

                    <tr>
                        <td><?php echo $product["sku"]; ?></td>
                        <td><?php echo $product["quantity"]; ?></td>
                        <td><?php echo $product["original_price"]; ?></td>
                        <td><?php echo $product["price"]; ?></td>
                        <td><?php echo $product["final_price"]; ?></td>
                        <td>
                            <a href="index.php?action=detail&id=<?php echo $product['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="index.php?action=remove&id=<?php echo $product['id']; ?>" class="btn btn-info">Remove</a>
                        </td>
                    </tr>

                    
                    <?php } ?>

                </tbody>
            </table>
            
        </section>
        
        
    </body>
    </html>