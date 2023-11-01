<?php
include './model/config.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


if (isset($_POST['add_to_cart'])) {
    if ($user_id === null) {
        // Người dùng chưa đăng nhập, hiển thị thông báo
        $message[] = 'Bạn cần đăng nhập trước khi thêm sản phẩm vào giỏ hàng.';
    } else {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = $pdo->prepare("SELECT * FROM `cart` WHERE name = :product_name AND user_id = :user_id");
        $check_cart_numbers->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $check_cart_numbers->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $check_cart_numbers->execute();

        if ($check_cart_numbers->rowCount() > 0) {
            $message[] = 'Sản phẩm đã được thêm vào giỏ hàng!';
        } else {
            $insert_query = $pdo->prepare("INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES (:user_id, :product_name, :product_price, :product_quantity, :product_image)");
            $insert_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_query->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $insert_query->bindParam(':product_price', $product_price, PDO::PARAM_STR);
            $insert_query->bindParam(':product_quantity', $product_quantity, PDO::PARAM_INT);
            $insert_query->bindParam(':product_image', $product_image, PDO::PARAM_STR);

            if ($insert_query->execute()) {
                $message[] = 'Sản phẩm đã được thêm vào giỏ hàng!';
            } else {
                $message[] = 'Không thể thêm sản phẩm vào giỏ hàng!';
            }
        }
    }
}
?>
