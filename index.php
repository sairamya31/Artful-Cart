<?php
session_start();
require_once("php/Createdb.php");
require_once('./php/component.php');

$database = new CreateDb("Productdb", "Producttb");

if(isset($_POST['add'])){
//print_r($_POST['product_id']);

if(isset($_SESSION['cart'])){
    $item_array_id = array_column($_SESSION['cart'], "product_id");
   // print_r($item_array_id);

    if(in_array($_POST['product_id'], $item_array_id)){
        echo "<script>alert('Product is already added in the cart...!')</script>";
        echo "<script>window.location = 'index.php'</script>";

    }else{
        $count = count($_SESSION['cart']);
        $item_array = array(
            'product_id' => $_POST['product_id']
        );$_SESSION['cart'][$count] = $item_array;
        //print_R($_SESSION['cart']);
     
    }
}
else{
    $item_array = array(
        'product_id' => $_POST['product_id']
    );
    $_SESSION['cart'][0] = $item_array;
    print_r($_SESSION['cart']);
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel = "stylesheet" href = "style.css">
</head>
<body>

<?php require_once("php/header.php"); ?>


   

    <div class = "container">
        <div class = "row text-center py-5">
           
         <?php
         $result = $database->getData();
         while($row = mysqli_fetch_assoc($result)){
            component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
         }
         ?>
        </div>
</div>
        

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>  
</body>
</body>
</html>