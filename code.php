<?php
session_start();
include("dbcon.php");
if(isset($_POST ["add_product"]))
{
    $product_name = $_POST['p_name'] ;
    $product_code = $_POST['p_code'] ;
    $product_quantity = $_POST['p_quantity'] ;
    $product_image = $_FILES['p_image']['name'] ;
    $product_image_tmp_name = $_FILES['p_image']['tmp_name'] ;
    $product_image_folder = 'uploaded_img/' . $product_image;

        $postData = [
            'p_name' => $product_name,
            'p_code' => $product_code,
            'p_quantity' => $product_quantity,
            'p_image' => [
                'name' => $product_image,
                'tmp_name' => $product_image_tmp_name,
                'folder' => $product_image_folder,
            ],
        ];
    $postData = ['product'];
    $postRef_result = $database->getReference('posts')->push($postData);

    if($postRef_result)
    {
        $_SESSION['status'] = "Product add Successuflly";
        header('Location: index.php?msg=New record created successfully');
    }
    else{
        $_SESSION['status'] = "Product Not add Successuflly";
        header('Location: index.php?msg=New record created successfully');
    }
}

?>