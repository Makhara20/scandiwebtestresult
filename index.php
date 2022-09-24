<?php
include_once 'db_config.php';
$statement = $pdo->prepare("SELECT * FROM products ORDER BY id desc");
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
<header class="container"> 
        <div class="headclass">
            <h1>Product List</h1>

            <div class="buttons">
                <a href="create.php" class="add">Add</a>
                <form method="post" action="delete.php" id="reavi" style="display: inline-block;">
                <!-- <input type="hidden" name="id" value="<?php echo $product['id'] ?>"> -->
                    <button type="submit" class="delete">Mass Delete</button>
                </form>
            </div>
        </div>
</header>
<div class="cont_box container">
<?php foreach ($products as $product) { ?>
    <div class="product">
    <div><input form="reavi" type="checkbox" name="id[]" value="<?php echo $product['id']; ?>"  class="delete-checkbox"></div>
    <div class="text-info">

        <span>#<?php echo $product['SKU'] ?></span> <br>
        <span><?php echo $product['title'] ?></span> <br>
        <span><?php echo $product['price'] ?> $</span> <br>
        <span><?php if($product['type_value'] == 'DVD') { echo 'Size: ' . $product['Size']; }
        else if($product['type_value'] == 'Furniture') { echo 'Dimension: ' . $product['height']."x"; echo $product['length']."x"; echo $product['width']; } 
        else if($product['type_value'] == 'Book') { echo 'Weight: ' . $product['Weight']; } ?> </span> <br>
</div>
    </div>
    <?php } ?>
</div>
<script src="./jquery.min.js"></script>
<script src="./create.js"></script>
</body>
</html>