<?php
if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xóa sinh viên
    $sql = "DELETE FROM t_sinhvien WHERE masv = '$masv'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa sinh viên thành công!";
    } else {
        die("Lỗi: " . $conn->error);
    }

    // Đóng kết nối
    $conn->close();
    echo "<a href='them_sinhvien.php'>Quay lại danh sách sinh viên</a>";
} else {
    die("Mã sinh viên không được cung cấp.");
}
?>
