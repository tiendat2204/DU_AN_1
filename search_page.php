<?php

include './controller/add_to_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tìm Kiếm</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Trang Tìm </h3>
        <p> <a href="index.php">Trang Chủ</a> / Tìm Kiếm </p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="Tìm Kiếm Sản Phẩm..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        <div class="box-container">
            <?php
            if (isset($_POST['submit'])) {
                $search_item = $_POST['search'];
                $select_products = $pdo->prepare("SELECT * FROM `products` WHERE name LIKE :search_item");
                $select_products->bindValue(':search_item', '%' . $search_item . '%', PDO::PARAM_STR);
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                        <form action="" method="post" class="box">
                            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
                            <div class="name"><?php echo $fetch_product['name']; ?></div>
                            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                            <input type="number" class="qty" name="product_quantity" min="1" value="1">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="btn" value="Thêm Giỏ Hàng" name="add_to_cart">
                        </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">Không có kết quả!</p>';
                }
            } else {
                echo '<p class="empty">Tìm Kiếm Thứ Gì Đó!</p>';
            }
            ?>
        </div>


    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>
