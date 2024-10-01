<?php
// Kiểm tra xem mã khoa đã được truyền vào chưa
if (isset($_GET['makhoa'])) {
    $makhoa = $_GET['makhoa'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy thông tin khoa
    $sql = "SELECT * FROM t_khoa WHERE makhoa = '$makhoa'";
    $result = $conn->query($sql);
    $khoa = $result->fetch_assoc();

    // Kiểm tra nếu không tìm thấy khoa
    if (!$khoa) {
        die("Không tìm thấy khoa.");
    }

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenkhoa = $_POST['tenkhoa'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];
        $dienthoai = $_POST['dienthoai'];

        // Cập nhật thông tin khoa
        $updateSql = "UPDATE t_khoa SET tenkhoa='$tenkhoa', email='$email', diachi='$diachi', dienthoai='$dienthoai' WHERE makhoa='$makhoa'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Cập nhật khoa thành công!";
            echo "<a href='them_khoa.php'>Quay lại danh sách khoa</a>";
            exit;
        } else {
            die("Lỗi: " . $conn->error);
        }
    }
} else {
    die("Mã khoa không được cung cấp.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Khoa</title>
</head>
<body>
<h1>Sửa Khoa</h1>
<form action="" method="POST">
    Tên khoa: <input type="text" name="tenkhoa" value="<?= $khoa['tenkhoa'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $khoa['email'] ?>" required><br>
    Địa chỉ: <input type="text" name="diachi" value="<?= $khoa['diachi'] ?>" required><br>
    Điện thoại: <input type="text" name="dienthoai" value="<?= $khoa['dienthoai'] ?>" required><br>
    <input type="submit" value="Cập nhật">
</form>
</body>
</html>
