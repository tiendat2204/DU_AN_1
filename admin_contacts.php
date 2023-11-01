<?php
include './model/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    
    try {
        // Sử dụng PDO để thực hiện truy vấn xóa
        $delete_statement = $pdo->prepare("DELETE FROM `message` WHERE id = :delete_id");
        $delete_statement->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
        $delete_statement->execute();
        header('location:admin_contacts.php');
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin nhắn</title>

    <!-- Liên kết đến font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Liên kết đến tệp CSS tùy chỉnh cho giao diện quản trị -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="messages">

        <h1 class="title">Tin nhắn</h1>

        <div class="box-container">
            <?php
            try {
                $select_message = $pdo->query("SELECT * FROM `message`");
                if ($select_message->rowCount() > 0) {
                    while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="box">
                            <p> ID người dùng : <span><?php echo $fetch_message['user_id']; ?></span> </p>
                            <p> Tên : <span><?php echo $fetch_message['name']; ?></span> </p>
                            <p> Số điện thoại : <span><?php echo $fetch_message['number']; ?></span> </p>
                            <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
                            <p> Nội dung tin nhắn : <span><?php echo $fetch_message['message']; ?></span> </p>
                            <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>"
                               onclick="return confirm('Xóa tin nhắn này?');" class="delete-btn">Xóa tin nhắn</a>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="empty">Bạn không có tin nhắn nào!</p>';
                }
            } catch (PDOException $e) {
                die('Truy vấn thất bại: ' . $e->getMessage());
            }
            ?>
        </div>

    </section>

    <!-- Liên kết đến tệp script JavaScript tùy chỉnh cho giao diện quản trị -->
    <script src="js/admin_script1.js"></script>

</body>

</html>
