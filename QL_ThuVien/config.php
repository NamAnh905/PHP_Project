<?php
    $mysqli  = new mysqli("localhost","root","","QL_ThuVien");

    if ($mysqli->connect_errno) {
        echo "Ket noi loi" . $mysqli->connect_error;
        exit();
    }
?>