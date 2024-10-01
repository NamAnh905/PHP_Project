<?php
if (isset($_GET['makhoa'])) {
    $makhoa = $_GET['makhoa'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xóa khoa
    $sql = "DELETE FROM t_khoa WHERE makhoa = '$makhoa'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa khoa thành công!";
    } else {
        die("Lỗi: " . $conn->error);
    }

    // Đóng kết nối
    $conn->close();
    echo "<a href='them_khoa.php'>Quay lại danh sách khoa</a>";
} else {
    die("Mã khoa không được cung cấp.");
}
?>
