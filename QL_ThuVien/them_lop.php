<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $malop = $_POST['malop'];
    $tenlop = $_POST['tenlop'];
    $email = $_POST['email'];
    $makhoa = $_POST['makhoa'];

    // Kết nối MySQL
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Thực hiện câu lệnh INSERT
    $sql = "INSERT INTO t_lop (malop, tenlop, email, makhoa) VALUES ('$malop', '$tenlop', '$email', '$makhoa')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm lớp thành công!";
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

<!-- Thêm Lớp -->
<h2>Thêm Lớp</h2>
<form action="" method="POST">
    Mã lớp: <input type="text" name="malop" required><br>
    Tên lớp: <input type="text" name="tenlop" required><br>
    Email: <input type="email" name="email" required><br>
    Mã khoa: <input type="text" name="makhoa" required><br>
    <input type="submit" value="Thêm">
</form>

<!-- Danh Sách Lớp -->
<h2>Danh Sách Lớp</h2>
<table>
    <tr>
        <th>Mã Lớp</th>
        <th>Tên Lớp</th>
        <th>Email</th>
        <th>Mã Khoa</th>
        <th>Hành Động</th>
    </tr>
    <?php
    // Kết nối MySQL để lấy danh sách lớp
    $conn = new mysqli("localhost", "root", "", "QL_Thuvien");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy danh sách lớp
    $result = $conn->query("SELECT * FROM t_lop");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['malop']}</td>
            <td>{$row['tenlop']}</td>
            <td>{$row['email']}</td>
            <td>{$row['makhoa']}</td>
            <td>
                <a href='sua_lop.php?malop={$row['malop']}'>Sửa</a>
                <a href='xoa_lop.php?malop={$row['malop']}'>Xóa</a>
            </td>
        </tr>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</table>
</body>
</html>
