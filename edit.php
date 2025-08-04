<?php include 'config.php';
if (!isset($_SESSION['login'])) header("Location: index.php");

$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM todos WHERE id='$id'");
$t = mysqli_fetch_assoc($q);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    mysqli_query($koneksi, "UPDATE todos SET task='$task', status='$status', deadline='$deadline' WHERE id='$id'");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Tugas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-body">
      <h4>Edit Tugas</h4>
      <form method="POST">
        <div class="mb-3">
          <input type="text" name="task" value="<?= htmlspecialchars($t['task']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <select name="status" class="form-select">
            <option value="pending" <?= $t['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="done" <?= $t['status'] == 'done' ? 'selected' : '' ?>>Selesai</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Deadline:</label>
          <input type="date" name="deadline" class="form-control" value="<?= $t['deadline'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
