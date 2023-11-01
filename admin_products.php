<?php

include './controller/adminCURDproduct.php';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>

    <!-- Liên kết đến font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Liên kết đến tệp CSS tùy chỉnh -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- Phần CRUD sản phẩm -->

    <section class="add-products">

        <h1 class="title">Cửa hàng sản phẩm</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Thêm sản phẩm</h3>
            <input type="text" name="name" class="box" placeholder="Nhập tên sản phẩm" required>
            <input type="number" min="0" name="price" class="box" placeholder="Nhập giá sản phẩm" required>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
            <input type="submit" value="Thêm sản phẩm" name="add_product" class="btn">
        </form>

    </section>

    <!-- Hiển thị sản phẩm -->

    <section class="show-products">

        <div class="box-container">

            <?php
            $select_products = $pdo->query("SELECT * FROM `products`");
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                        <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Xóa sản phẩm này?');">Xóa</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Chưa có sản phẩm nào được thêm!</p>';
            }
            ?>
        </div>

    </section>

    <section class="edit-product-form">

        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update_query = $pdo->prepare("SELECT * FROM `products` WHERE id = :update_id");
            $update_query->bindParam(':update_id', $update_id, PDO::PARAM_INT);
            $update_query->execute();
            if ($update_query->rowCount() > 0) {
                while ($fetch_update = $update_query->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                        <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Nhập tên sản phẩm">
                        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Nhập giá sản phẩm">
                        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                        <input type="submit" value="Cập nhật" name="update_product" class="btn">
                        <input type="reset" value="Hủy" id="close-update" class="option-btn">
                    </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>

    </section>

    <!-- Liên kết đến tệp JS tùy chỉnh của quản trị viên -->
    <script src="js/admin_script1.js"></script>

</body>

</html>
