<?php
session_start();

include 'config.php';
if(isset($_POST['add_product'])){
        $product_name = $_POST['p_name'] ?? '';
        $product_code = $_POST['p_code'] ?? '';
        $product_quantity = $_POST['p_quantity'] ?? '';
        $product_image = $_FILES['p_image']['name'] ?? '';
        $product_image_tmp_name = $_FILES['p_image']['tmp_name'] ?? '';
        $product_image_folder = 'uploaded_img/' . $product_image;
     
        $sql = "INSERT INTO `product1`(`id`, `name`, `code`, `quantity`, `image`) VALUES (NULL,'$product_name', '$product_code', '$product_quantity', '$product_image')";
     
        $result = mysqli_query($conn, $sql);
     
        if ($result) {
           header("Location: index.php?msg=New record created successfully");
        } else {
           echo "Failed: " . mysqli_error($conn);
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Items</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">

        <div class="add-product-form">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">

            <h3>ADD A NEW PRODUCT</h3>

            <input type="text" name="p_name" placeholder="Product name" class="box" required>
            <input type="text" name="p_code" placeholder="The product code" class="box" required>
            <input type="number" name="p_quantity" min="1" placeholder="The product quantity" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg"  class="box" required>
            <input type="submit" class="btnProduct" name="add_product" value="ADD THE PRODUCT">
            
            </form>

        </div>

            <?php

             $select = mysqli_query($conn, "SELECT * FROM product1");
             
            ?>

                <div class="product-display"></div>
                <table class="product-display-table" cellpadding="10" cellspacing="1">
                    <thead>
                    <tr>
                        <th style="text-align:center;" width="10%">Name</th>
                        <th style="text-align:left;" width="35%">Code</th>
                        <th style="text-align:center;" width="10%">Quantity</th>
                        <th style="text-align:center;" width="9%">Action</th>
                    </tr>
                    </thead>
                    <?php
                        $totalQuantity=0;
                        while($row = mysqli_fetch_assoc($select)){
                        ?>
                    
                        <tr>
                        <td style="text-align: center;"><img src="uploaded_img/<?php echo $row["image"]; ?>" class="cart-item-image" alt=""></td>
                        <td><?php echo $row["code"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["quantity"]; ?></td>
                        <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-trash"></i></a>
                        </tr>
                        <?php
                        $totalQuantity += $row["quantity"];
                    ?>
                    <?php }?>

                    <!--  Total Quantity  -->
                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td style="text-align: center;"><?php echo $totalQuantity; ?></td>
                        <td></td>
                        </tr>
                </table>
            </div>
    </body>
</html>