<?php
include "config.php";
$id = $_GET['id'];

if (isset($_POST['update_product'])) {
    $updated_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $updated_code = mysqli_real_escape_string($conn, $_POST['p_code']);
    $updated_quantity = (int)$_POST['p_quantity'];

    // Check if a file was uploaded
    if (!empty($_FILES['p_image']['name'])) {
        $product_image_tmp_name = $_FILES['p_image']['tmp_name'];
        $product_image = mysqli_real_escape_string($conn, $_FILES['p_image']['name']);

        // Update the product with the new image
        $update_query = "UPDATE product1 SET name='$updated_name', code='$updated_code', quantity=$updated_quantity, image='$product_image' WHERE id = $id";
        
        // Move the uploaded file to the destination folder
        $upload_destination = 'uploaded_img/' . $product_image;
        move_uploaded_file($product_image_tmp_name, $upload_destination);
    } 
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        header("Location: index.php?msg=Product updated successfully");
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }

    .admin-product-form-container {
        max-width: 500px;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .box {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .box:focus {
        outline: none;
        border-color: #4caf50;
    }

    .btnProduct {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btnProduct:hover {
        background-color: black;
    }
</style>

    <div class="container">

        <div class="admin-product-form-container centered">

            <?php 
            $select = mysqli_query($conn, "SELECT * FROM product1 WHERE id = $id");
            while($row = mysqli_fetch_assoc($select)){
            ?>    

            <form action="" method="post" enctype="multipart/form-data">

            <h3 class="title"> Update The product </h3>

            <input type="text" name="p_name"  placeholder="The product name" class="box" value="<?php echo $row['name']; ?>" required>
            <input type="text" name="p_code"  placeholder="The product code" class="box" value="<?php echo $row["code"]; ?>" required>
            <input type="number" name="p_quantity" min="1" placeholder="The product quantity" class="box" value="<?php echo $row['quantity']; ?>" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box"  required>
            <input type="submit" class="btnProduct" name="update_product" value="UPDATE THE PRODUCT">
        
            </form>
            <?php } ?>
            <?php

             $select = mysqli_query($conn, "SELECT * FROM product1");
             
            ?>

        </div>
    </div>
</body>
</html>