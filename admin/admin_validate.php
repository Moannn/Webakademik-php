<?php
    session_start();
    $USERNAME = $_POST['username'];
    $PASSWORD = $_POST['password'];

    include "../config/db_connection.php";
    $query = "SELECT * FROM admin WHERE username = '$USERNAME' AND password_admin='$PASSWORD'";

    $res = $conn->query($query);

    if($row = $res->fetch_row()){
        $_SESSION['logged-in'] = true;
        $_SESSION['username'] = $USERNAME;
        header('Location: admin_home_page.php?page=dashboard');
    }
    else{
        $_SESSION['salah'] = 'salah';
        header('Location: index.php');
    }
?>