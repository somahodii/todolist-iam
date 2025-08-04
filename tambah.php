<?php include 'config.php';
if (!isset($_SESSION['login'])) header("Location: index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];
    $uid = $_SESSION['user_id'];
    mysqli_query($koneksi, "INSERT INTO todos (user_id, task, deadline) VALUES ('$uid', '$task', '$deadline')");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Tugas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-body">
      <h4>Tambah Tugas</h4>
      <form method="POST">
        <div class="mb-3">
          <input type="text" name="task" class="form-control" required placeholder="Isi tugas">
        </div>
        <div class="mb-3">
          <label>Deadline:</label>
          <input type="date" name="deadline" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
