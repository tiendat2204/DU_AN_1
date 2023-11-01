<?php
include './controller/add_to_cart.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- swiper css file cnd link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

</head>

<body>

    <?php include 'header.php'; ?>
    <section class="home" id="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="item swiper-slide">
                    <img src="images/home4.jpeg" alt="" />
                    <div class="content">
                        <h3>Đọc sách để thành công.</h3>
                        <p style="color: #000;">
                        Một quyển sách hay là đời sống xương máu quý giá của một tinh thần ướp hương và cất kín cho mai sau. ( J.Milton)
                        </p>
                        <a href="about.php"><button class="white-btn">discover</button></a>
                    </div>
                </div>

                <div class="item swiper-slide">
                    <img src="images/home1.jpeg" alt="" />
                    <div class="content">
                        <h3>Sách là cửa sổ tâm hồn</h3>
                        <p style="color: #000;">
                        Gặp được một quyển sách hay nên mua liền dù đọc được hay không đọc được, vì sớm muộn gì cũng cần đến nó. (W.Churchill)
                        </p>
                        <a href="shop.php"><button class="white-btn">discover</button></a>
                    </div>
                </div>

                <div class="item swiper-slide">
                    <img src="images/home2.webp" alt="" />
                    <div class="content">
                        <h3>Một quyển sách hay</h3>
                        <p style="color: #000;">
                        Một cuốn sách hay cho ta một điều tốt, một người bạn tốt cho ta một điều hay (Gustavơ Lebon)
                        </p>
                        <a href="contact.php"><button class="white-btn">discover</button></a>
                    </div>
                </div>

                <div class="item swiper-slide">
                    <img src="images/home3.jpeg" alt="" />
                    <div class="content">
                        <h3>Con đường thành công</h3>
                        <p style="color: #000;">
                        "Chính từ sách mà những người khôn ngoan tìm được sự an ủi khỏi những rắc rối của cuộc đời.” - Victor Hugo
                        </p>
                        <a href="#"><button class="white-btn">discover</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products">
    <h1 class="title">Đề xuất</h1>
    <div class="box-container">
        <?php
        $select_products = $pdo->query("SELECT * FROM `products` LIMIT 8");

        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                
                ?>
                <form action="" method="post" class="box">
                <a href="product_detail.php?product_id=<?php echo $fetch_products['id']; ?>">
            <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
        </a>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <input type="submit" value="Thêm giỏ hàng" name="add_to_cart" class="btn">
                </form>
             
                <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>

    <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="shop.php" class="option-btn">ĐỌC THÊM</a>
    </div>
</section>


    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>Về chúng tôi</h3>
                <p>"Vào khoảnh khắc mà chúng ta quyết thuyết phục đứa trẻ, bất cứ đứa trẻ nào, bước qua bậc thềm ấy, bậc thềm màu nhiệm dẫn vào thư viện, ta thay đổi cuộc sống của nó mãi mãi, theo cách tốt đẹp hơn.” - Barack Obama</p>
                <a href="about.php" class="btn"> đọc thêm</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>bạn có thắc mắc?</h3>
            <p>"Chúng ta sẽ trở thành gì phụ thuộc vào điều chúng ta đọc sau khi các thầy cô giáo đã xong việc với chúng ta. Trường học vĩ đại nhất chính là sách vở.” - Thomas Carlyle</p>
            <a href="contact.php" class="white-btn">liên hệ chúng tôi</a>
        </div>

    </section>





    <?php include 'footer.php'; ?>

    <!-- swiper js file cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- custom js file link -->
    <script src="js/script.js"></script>

</body>

</html>