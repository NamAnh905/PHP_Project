<?php
if (isset($_GET['malop'])) {
    $malop = $_GET['malop'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xóa lớp
    $sql = "DELETE FROM t_lop WHERE malop = '$malop'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa lớp thành công!";
    } else {
        die("Lỗi: " . $conn->error);
    }

    // Đóng kết nối
    $conn->close();
    echo "<a href='them_lop.php'>Quay lại danh sách lớp</a>";
} else {
    die("Mã lớp không được cung cấp.");
}
?>
