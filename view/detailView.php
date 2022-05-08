<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Supermarket</title>
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
        <div class="col-lg-5 mr-auto">
            <form action="index.php?action=edit" method="post">
                <h3>Product detail</h3>
                <hr/>
                <input type="hidden" name="id" value="<?php echo $data["checkout"]->id ?>"/>
                Product: <select name="Name" class="form-control" value="<?=$data['checkout']->sku?>">
                <?php 
                    foreach($data['products'] as $product) {?>
                        <option 
                            value="<?php echo $product['sku']; ?>" 
                            <?php echo ($product['sku'] == $data['checkout']->sku)?"selected=selected":"" ?>
                        >
                            <?php echo $product['sku']; ?>
                        </option>
                <?php } ?>
            </select>
            Quantity: <input type="text" autocomplete="off" name="Quantity" value="<?=$data['checkout']->quantity?>" class="form-control"/>
                <input type="submit" value="Edit" class="btn btn-success"/>
                <a href="index.php" class="btn btn-info">Back</a>
            </form>
            
        </div>
       
    </body>
</html>