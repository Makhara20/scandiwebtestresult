<?php 
include_once 'db_config.php';
$errors = [];

$sku = '';
$title = '';
$price = '';
$dvdsize = "";
$fheight = "";
$fwidth = "";
$flength = "";
$bweight = "";
$type = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sku = $_POST['SKU'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $dvdsize = $_POST['Size'];
    $fheight = $_POST['height'];
    $flength = $_POST['length'];
    $fwidth = $_POST['width'];
    $bweight = $_POST['Weight'];
    if(isset($_POST['type_value'])) {
      $type = $_POST['type_value'];
    }

    if(!$sku) {
        $errors[] = 'Product SKU is required';
    }

    if(!$title) {
        $errors[] = 'Product title is required';
    }

    if(!$price) {
      $errors[] = 'Product price is required';
    }

    if(!$type) {
      $errors[] = 'Product type is required';
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products (SKU, title, price, Size, height, length, width, Weight, type_value)
                VALUES (:sku, :title, :price, :Size, :height, :length, :width, :Weight, :type_value)");
        $statement->bindValue(':sku', $sku);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':Size', $dvdsize); 
        $statement->bindValue(':height', $fheight);
        $statement->bindValue(':length', $flength);
        $statement->bindValue(':width', $fwidth);
        $statement->bindValue(':Weight', $bweight);
        $statement->bindValue(':type_value', $type);

   
        $statement->execute();
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<header class="container"> 
        <div class="headclass">
            <h1>Product Add</h1>

            <div class="buttons">
                <a href="index.php" class="add">cancel</a>
                <button form="product_form" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
</header>

<div class="container">
<br>
<?php if(!empty($errors)) : ?>

<div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
        <div><?php echo $error ?></div> 
    <?php endforeach; ?>
</div>

<?php endif; ?>


  <div class="create_forms">
<form method="post" enctype="multipart/form-data" id="product_form">
  <div class="mb-3">
    <label class="form-label">SKU</label>
    <input type="text" name="SKU" class="form-control" value="<?php echo $sku ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Price ($)</label>
    <input type="number" step=".01" name="price" class="form-control" value="<?php echo $price ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Type Switcher</label>
  <select id="selectee" class="form-select" name='type_value' aria-label="Type Switcher" onchange="getCall(this.value);">
      <option value disabled selected>Type Switcher</option>
      <option value="DVD">DVD-Disc</option>
      <option value="Furniture">Furniture</option>
      <option value="Book">Book</option>
  </select>




  </div>
  <br>
  <div id="DVD" class="controls" style="display: none;">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Size (MB)</label>
      <div class="col-sm">
        <input name="Size" type="number" class="form-control cleardiv" id="size"><br>
        <strong>Please, provide disc space in MB</strong>
      </div>
    </div>
  </div>

  <div for="Dimensions" name="dimensions" id="Furniture" class="controls" style="display: none;">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Height (CM)</label>
      <div class="col-sm">
        <input name="height" type="number" class="form-control cleardiv" id="height">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Width (CM)</label>
      <div class="col-sm">
        <input name="width" type="number" class="form-control cleardiv" id="width">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Length (CM)</label>
      <div class="col-sm">
        <input name="length" type="number" class="form-control cleardiv" id="length"><br>
        <strong>Please, provide dimensions</strong>
      </div><br>
    </div>
  </div>

  <div id="Book" class="controls" style="display: none;">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Weight (KG)</label>
      <div class="col-sm">
        <input name="Weight" type="number" class="form-control cleardiv" id="weight"><br>
        <strong>Please, provide weight in KG</strong>
      </div><br>
    </div>
  </div>
 <br>
</form>
</div>
</div>

</script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/create.js"></script>
</body>
</html>
