<?php
// Kiểm tra xem mã lớp đã được truyền vào chưa
if (isset($_GET['malop'])) {
    $malop = $_GET['malop'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy thông tin lớp
    $sql = "SELECT * FROM t_lop WHERE malop = '$malop'";
    $result = $conn->query($sql);
    $lop = $result->fetch_assoc();

    // Kiểm tra nếu không tìm thấy lớp
    if (!$lop) {
        die("Không tìm thấy lớp.");
    }

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenlop = $_POST['tenlop'];
        $email = $_POST['email'];
        $makhoa = $_POST['makhoa'];

        // Cập nhật thông tin lớp
        $updateSql = "UPDATE t_lop SET tenlop='$tenlop', email='$email', makhoa='$makhoa' WHERE malop='$malop'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Cập nhật lớp thành công!";
            echo "<a href='them_lop.php'>Quay lại danh sách lớp</a>";
            exit;
        } else {
            die("Lỗi: " . $conn->error);
        }
    }
} else {
    die("Mã lớp không được cung cấp.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lớp</title>
</head>
<body>
<h1>Sửa Lớp</h1>
<form action="" method="POST">
    Tên lớp: <input type="text" name="tenlop" value="<?= $lop['tenlop'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $lop['email'] ?>" required><br>
    Mã khoa: <input type="text" name="makhoa" value="<?= $lop['makhoa'] ?>" required><br>
    <input type="submit" value="Cập nhật">
</form>
</body>
</html>
