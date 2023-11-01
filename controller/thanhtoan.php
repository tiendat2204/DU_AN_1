<?php
include './model/config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['order_btn'])) {

    $name = htmlspecialchars($_POST['name']);
    $number = $_POST['number'];
    $email = htmlspecialchars($_POST['email']);
    $method = htmlspecialchars($_POST['method']);
    $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = array();

    $cart_query = $pdo->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
    $cart_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $cart_query->execute();

    if ($cart_query->rowCount() > 0) {
        while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = $pdo->prepare("SELECT * FROM `orders` WHERE name = :name AND number = :number AND email = :email AND method = :method AND address = :address AND total_products = :total_products AND total_price = :cart_total");
    $order_query->bindParam(':name', $name, PDO::PARAM_STR);
    $order_query->bindParam(':number', $number, PDO::PARAM_STR);
    $order_query->bindParam(':email', $email, PDO::PARAM_STR);
    $order_query->bindParam(':method', $method, PDO::PARAM_STR);
    $order_query->bindParam(':address', $address, PDO::PARAM_STR);
    $order_query->bindParam(':total_products', $total_products, PDO::PARAM_STR);
    $order_query->bindParam(':cart_total', $cart_total, PDO::PARAM_STR);
    $order_query->execute();

    if ($cart_total == 0) {
        $message[] = 'giỏ hàng trống';
    } else {
        if ($order_query->rowCount() > 0) {
            $message[] = 'đơn hàng đã được đặt rồi!';
        } else {
            $insert_order_query = $pdo->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(:user_id, :name, :number, :email, :method, :address, :total_products, :cart_total, :placed_on)");
            $insert_order_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_order_query->bindParam(':name', $name, PDO::PARAM_STR);
            $insert_order_query->bindParam(':number', $number, PDO::PARAM_STR);
            $insert_order_query->bindParam(':email', $email, PDO::PARAM_STR);
            $insert_order_query->bindParam(':method', $method, PDO::PARAM_STR);
            $insert_order_query->bindParam(':address', $address, PDO::PARAM_STR);
            $insert_order_query->bindParam(':total_products', $total_products, PDO::PARAM_STR);
            $insert_order_query->bindParam(':cart_total', $cart_total, PDO::PARAM_STR);
            $insert_order_query->bindParam(':placed_on', $placed_on, PDO::PARAM_STR);

            $insert_order_query->execute();
            $message[] = 'đơn hàng đã được đặt thành công!';

            $delete_cart_query = $pdo->prepare("DELETE FROM `cart` WHERE user_id = :user_id");
            $delete_cart_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $delete_cart_query->execute();
        }
    }
}
?>
