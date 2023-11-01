<?php
include './model/config.php';

session_start();



// Trích xuất giá trị của tham số product_id từ URL
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

if ($product_id !== null) {
    // Sử dụng $product_id để truy vấn cơ sở dữ liệu và hiển thị thông tin sản phẩm chi tiết ở đây.
    $product_query = $pdo->prepare("SELECT * FROM `products` WHERE id = :product_id");
    $product_query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $product_query->execute();

    if ($product_query->rowCount() > 0) {
        // Lấy thông tin sản phẩm
        $product_data = $product_query->fetch(PDO::FETCH_ASSOC);

        // Lấy thông tin chi tiết từ cơ sở dữ liệu
        $product_info = $product_data['in4'];

        // Hiển thị các thông tin sản phẩm chi tiết
        $product_name = $product_data['name'];
        $product_price = $product_data['price'];
        $product_image = $product_data['image'];
    } else {
        // Hiển thị thông báo lỗi nếu sản phẩm không tồn tại
        echo 'Sản phẩm không tồn tại.';
        exit();
    }
} else {
    // Hiển thị thông báo lỗi nếu không có tham số product_id trong URL
    echo 'Thiếu thông tin sản phẩm.';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="css/style.css">

<!-- swiper css file cnd link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />


    <!-- Add your CSS and other HTML elements for displaying the product details here -->
</head>
<body>
<?php include 'header.php'; ?>
   <div class="product_detail">

       <img src="uploaded_img/<?php echo $product_image; ?>" alt="Product Image" class="img_detail">
       <h2 class="name_detail"><?php echo $product_name; ?></h2>
       <p class="price_detail">Price: $<?php echo $product_price; ?></p>
       <!-- Add more product details as needed -->
       <div class="product_info">
          <p>

              <?php echo $product_info; ?>  
          </p> 
       </div>
       
       <!-- You can also add a button to go back to the index page if needed -->
       <a href="index.php" class="btn_gohome">Trở về trang chủ</a>
    </div>
    <!-- Form bình luận -->
<form action="post_comment.php" method="post" class="comment-form">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="text" name="comment" placeholder="Nhập bình luận của bạn" required>
    <button type="submit" class="btn_comment">Gửi bình luận</button>
</form>

<!-- Hiển thị danh sách bình luận -->
<!-- Hiển thị danh sách bình luận -->
<div class="comments">
    <h3>Bình luận:</h3>
    
    <?php
    $get_comments_query = $pdo->prepare("SELECT * FROM comment WHERE product_id = :product_id ORDER BY created_at DESC");

    $get_comments_query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $get_comments_query->execute();

    if ($get_comments_query->rowCount() > 0) {
        while ($comment_row = $get_comments_query->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $comment_row['user_id'];
            $comment_text = $comment_row['message'];
            $created_at = $comment_row['created_at'];

            // Lấy thông tin người dùng
            $get_user_query = $pdo->prepare("SELECT name FROM users WHERE id = :user_id");
            $get_user_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $get_user_query->execute();
            $user_row = $get_user_query->fetch(PDO::FETCH_ASSOC);
            $username = $user_row['name'];

            // Hiển thị thời gian bình luận
            $comment_time = date('Y-m-d H:i:s', strtotime($created_at));

            echo "<div class='comment-container'>
            <p class='comment'><strong>$username:</strong> $comment_text</p>
            <p class='comment-time'>$comment_time</p>
        </div>";
  
        }
    } else {
        echo "<p>Chưa có bình luận nào.</p>";
    }
    ?>
</div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="js/script.js"></script>
</body>
</html>
