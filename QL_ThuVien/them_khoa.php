<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $makhoa = $_POST['makhoa'];
    $tenkhoa = $_POST['tenkhoa'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Thực hiện câu lệnh INSERT
    $sql = "INSERT INTO t_khoa (makhoa, tenkhoa, email, diachi, dienthoai) VALUES ('$makhoa', '$tenkhoa', '$email', '$diachi', '$dienthoai')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm khoa thành công!";
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

<!-- Thêm Khoa -->
<h2>Thêm Khoa</h2>
<form action="" method="POST">
    Mã khoa: <input type="text" name="makhoa" required><br>
    Tên khoa: <input type="text" name="tenkhoa" required><br>
    Email: <input type="email" name="email" required><br>
    Địa chỉ: <input type="text" name="diachi" required><br>
    Điện thoại: <input type="text" name="dienthoai" required><br>
    <input type="submit" value="Thêm">
</form>

<!-- Danh Sách Khoa -->
<h2>Danh Sách Khoa</h2>
<table>
    <tr>
        <th>Mã Khoa</th>
        <th>Tên Khoa</th>
        <th>Email</th>
        <th>Địa Chỉ</th>
        <th>Điện Thoại</th>
        <th>Hành Động</th>
    </tr>
    <?php
    // Kết nối MySQL để lấy danh sách khoa
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy danh sách khoa
    $result = $conn->query("SELECT * FROM t_khoa");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['makhoa']}</td>
            <td>{$row['tenkhoa']}</td>
            <td>{$row['email']}</td>
            <td>{$row['diachi']}</td>
            <td>{$row['dienthoai']}</td>
            <td>
                <a href='sua_khoa.php?makhoa={$row['makhoa']}'>Sửa</a>
                <a href='xoa_khoa.php?makhoa={$row['makhoa']}'>Xóa</a>
            </td>
        </tr>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</table>
</body>
</html>
