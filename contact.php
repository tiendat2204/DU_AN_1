<?php
include './model/config.php';

session_start();

if (isset($_POST['send'])) {
    // Check if a user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $msg = $_POST['message'];

        $select_message = $pdo->prepare("SELECT * FROM `message` WHERE name = :name AND email = :email AND number = :number AND message = :msg");
        $select_message->bindParam(':name', $name, PDO::PARAM_STR);
        $select_message->bindParam(':email', $email, PDO::PARAM_STR);
        $select_message->bindParam(':number', $number, PDO::PARAM_STR);
        $select_message->bindParam(':msg', $msg, PDO::PARAM_STR);
        $select_message->execute();

        if ($select_message->rowCount() > 0) {
            $message[] = 'Tin nhắn chưa gửi!';
        } else {
            $insert_message = $pdo->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(:user_id, :name, :email, :number, :msg)");
            $insert_message->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_message->bindParam(':name', $name, PDO::PARAM_STR);
            $insert_message->bindParam(':email', $email, PDO::PARAM_STR);
            $insert_message->bindParam(':number', $number, PDO::PARAM_STR);
            $insert_message->bindParam(':msg', $msg, PDO::PARAM_STR);
            $insert_message->execute();

            $message[] = 'Gửi tin nhắn thành công';
        }
    } else {
        // Handle the case where the user is not logged in, for example:
        $message[] = 'Bạn cần đăng nhập để gửi tin nhắn';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include 'header.php'; ?>

<div class="heading">
    <h3>liên hệ chúng tôi</h3>
    <p> <a href="index.php">trang chủ</a> / liên hệ </p>
</div>

<section class="contact">

    <form action="" method="post">
        <h3>nói gì đó!</h3>
        <input type="text" name="name" required placeholder="Tên" class="box">
        <input type="email" name="email" required placeholder="email" class="box">
        <input type="number" name="number" required placeholder="Số điện thoại" class="box">
        <textarea name="message" class="box" placeholder="Tin nhắn" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="gửi ngay" name="send" class="btn">
    </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>

</html>