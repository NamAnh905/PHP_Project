<?php
// Kiểm tra xem mã sinh viên đã được truyền vào chưa
if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy thông tin sinh viên
    $sql = "SELECT * FROM t_sinhvien WHERE masv = '$masv'";
    $result = $conn->query($sql);
    $sinhvien = $result->fetch_assoc();

    // Kiểm tra nếu không tìm thấy sinh viên
    if (!$sinhvien) {
        die("Không tìm thấy sinh viên.");
    }

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $namsinh = $_POST['namsinh'];
        $diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $dienthoai = $_POST['dienthoai'];
        $malop = $_POST['malop'];

        // Cập nhật thông tin sinh viên
        $updateSql = "UPDATE t_sinhvien SET hoten='$hoten', gioitinh='$gioitinh', namsinh='$namsinh', diachi='$diachi', email='$email', dienthoai='$dienthoai', malop='$malop' WHERE masv='$masv'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Cập nhật sinh viên thành công!";
            echo "<a href='them_sinhvien.php'>Quay lại danh sách sinh viên</a>";
            exit;
        } else {
            die("Lỗi: " . $conn->error);
        }
    }
} else {
    die("Mã sinh viên không được cung cấp.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sinh Viên</title>
</head>
<body>
<h1>Sửa Sinh Viên</h1>
<form action="" method="POST">
    Họ tên: <input type="text" name="hoten" value="<?= $sinhvien['hoten'] ?>" required><br>
    Giới tính: <input type="text" name="gioitinh" value="<?= $sinhvien['gioitinh'] ?>" required><br>
    Năm sinh: <input type="text" name="namsinh" value="<?= $sinhvien['namsinh'] ?>" required><br>
    Địa chỉ: <input type="text" name="diachi" value="<?= $sinhvien['diachi'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $sinhvien['email'] ?>" required><br>
    Điện thoại: <input type="text" name="dienthoai" value="<?= $sinhvien['dienthoai'] ?>" required><br>
    Mã lớp: <input type="text" name="malop" value="<?= $sinhvien['malop'] ?>" required><br>
    <input type="submit" value="Cập nhật">
</form>
</body>
</html>
