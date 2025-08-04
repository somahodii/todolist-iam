<?php include 'config.php';
if (!isset($_SESSION['login'])) header("Location: index.php");

$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['role'] === 'admin';

$todos = $is_admin
  ? mysqli_query($koneksi, "SELECT * FROM todos")
  : mysqli_query($koneksi, "SELECT * FROM todos WHERE user_id='$user_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - To-Do List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand">To-Do List</span>
    <a href="logout.php" class="btn btn-outline-light">Logout</a>
  </div>
</nav>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Tugas</h4>
    <a href="tambah.php" class="btn btn-success">+ Tambah</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr><th>Tugas</th><th>Status</th><th>Deadline</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php while($t = mysqli_fetch_assoc($todos)) {
      $expired = strtotime($t['deadline']) < strtotime(date('Y-m-d'));
    ?>
      <tr>
        <td><?= htmlspecialchars($t['task']) ?></td>
        <td><span class="badge bg-<?= $t['status'] == 'done' ? 'success' : 'warning' ?>"><?= $t['status'] ?></span></td>
        <td class="<?= $expired ? 'text-danger' : '' ?>">
          <?= date('d M Y', strtotime($t['deadline'])) ?>
        </td>
        <td>
          <a href="edit.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-primary <?= $expired ? 'disabled' : '' ?>">Edit</a>
          <a href="hapus.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-danger <?= $expired ? 'disabled' : '' ?>" onclick="return confirm('Yakin?')">Hapus</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
