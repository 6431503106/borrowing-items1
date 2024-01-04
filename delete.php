<?php
include "config.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // ดำเนินการลบข้อมูลใน MySQL
    $delete_query = "DELETE FROM product1 WHERE id = $product_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        header("Location: index.php?msg=Product deleted successfully");
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
        exit();
    }
} else {
    // ถ้าไม่มี ID ที่ถูกส่งมาหรือไม่ใช่ตัวเลข
    echo "Invalid product ID.";
    exit();
}
?>