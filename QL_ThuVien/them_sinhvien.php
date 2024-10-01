<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $masv = $_POST['masv'];
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $namsinh = $_POST['namsinh'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $malop = $_POST['malop'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Thực hiện câu lệnh INSERT
    $sql = "INSERT INTO t_sinhvien (masv, hoten, gioitinh, namsinh, diachi, email, dienthoai, malop) VALUES ('$masv', '$hoten', '$gioitinh', '$namsinh', '$diachi', '$email', '$dienthoai', '$malop')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sinh viên thành công!";
    } else {
        die("Lỗi: " . $conn->error); // Dừng và hiển thị lỗi
    }

    // Đóng kết nối
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thư Viện</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #007BFF;
            margin-top: 30px;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
        }
        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Quản Lý Thư Viện</h1>

<!-- Thêm Sinh Viên -->
<h2>Thêm Sinh Viên</h2>
<form action="" method="POST">
    Mã sinh viên: <input type="text" name="masv" required><br>
    Họ tên: <input type="text" name="hoten" required><br>
    Giới tính: <input type="text" name="gioitinh" required><br>
    Năm sinh: <input type="text" name="namsinh" required><br>
    Địa chỉ: <input type="text" name="diachi" required><br>
    Email: <input type="email" name="email" required><br>
    Điện thoại: <input type="text" name="dienthoai" required><br>
    Mã lớp: <input type="text" name="malop" required><br>
    <input type="submit" value="Thêm">
</form>

<!-- Danh Sách Sinh Viên -->
<h2>Danh Sách Sinh Viên</h2>
<table>
    <tr>
        <th>Mã Sinh Viên</th>
        <th>Họ Tên</th>
        <th>Giới Tính</th>
        <th>Năm Sinh</th>
        <th>Địa Chỉ</th>
        <th>Email</th>
        <th>Điện Thoại</th>
        <th>Mã Lớp</th>
        <th>Hành Động</th>
    </tr>
    <?php
    // Kết nối MySQL để lấy danh sách sinh viên
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy danh sách sinh viên
    $result = $conn->query("SELECT * FROM t_sinhvien");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['masv']}</td>
            <td>{$row['hoten']}</td>
            <td>{$row['gioitinh']}</td>
            <td>{$row['namsinh']}</td>
            <td>{$row['diachi']}</td>
            <td>{$row['email']}</td>
            <td>{$row['dienthoai']}</td>
            <td>{$row['malop']}</td>
            <td>
                <a href='sua_sinhvien.php?masv={$row['masv']}'>Sửa</a>
                <a href='xoa_sinhvien.php?masv={$row['masv']}'>Xóa</a>
            </td>
        </tr>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</table>
</body>
</html>
