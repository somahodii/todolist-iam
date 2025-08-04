<?php include 'config.php';
if (!isset($_SESSION['login'])) header("Location: index.php");

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM todos WHERE id='$id'");
header("Location: dashboard.php");
