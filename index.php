<?php
// Koneksi ke function CRUD
include "task.php";

// Mengambil Data Tugas
$order = 'due_date ASC'; // Default order untuk pengurutan
if (isset($_POST['sort'])) {
    // Mengatur urutan berdasarkan pilihan pengguna
    $order = $_POST['sort'] == 'latest' ? 'due_date DESC' : 'due_date ASC';
}

// Query untuk mengambil data tugas dari database dengan urutan yang ditentukan
$result = mysqli_query($koneksi, "SELECT * FROM tasks ORDER BY $order");

// Cek jika ada data untuk diedit
$task_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // Mengambil data tugas berdasarkan ID untuk diedit
    $result_edit = mysqli_query($koneksi, "SELECT * FROM tasks WHERE id=$id");
    $task_data = mysqli_fetch_assoc($result_edit);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("asset/header.php"); ?> <!-- Menyertakan header -->

    <div class="container mt-2">
        <br>
        <!-- Form untuk Menambah atau Mengedit Tugas -->
        <form method="POST" action="task.php" class="border rounded bg-light p-2">
            <h2 class="text-center"><?php echo $task_data ? 'Edit Daftar Tugas' : 'Tambah Daftar Tugas'; ?></h2>
            <?php if ($task_data) { ?>
                <input type="hidden" name="id" value="<?php echo $task_data['id']; ?>"> <!-- Menyimpan ID tugas yang sedang diedit -->
            <?php } ?>
            <label class="form-label">Nama Task</label>
            <input type="text" name="task" class="form-control" placeholder="Masukan Tugas Anda" 
            value="<?php echo $task_data ? $task_data['task'] : ''; ?>" autocomplete="off" autofocus required>
            <label class="form-label">Prioritas</label>
            <select name="priority" class="form-control" required>
                <option value="" disabled <?php echo !$task_data ? 'selected' : ''; ?>>--Pilih Prioritas--</option>
                <option value="1" <?php echo $task_data && $task_data['priority'] == 1 ? 'selected' : ''; ?>>tidak penting</option>
                <option value="2" <?php echo $task_data && $task_data['priority'] == 2 ? 'selected' : ''; ?>>penting</option>
                <option value="3" <?php echo $task_data && $task_data['priority'] == 3 ? 'selected' : ''; ?>>sangat penting</option>
            </select>
            <label class="form-label">Tanggal</label>
            <input type="date" name="due_date" class="form-control" 
            value="<?php echo $task_data ? $task_data['due_date'] : date('Y-m-d'); ?>" required>
            <button type="submit" class="btn btn-primary w-100 mt-2" name="<?php echo $task_data ? 'update_task' : 'tabah_tugas'; ?>">
                <?php echo $task_data ? 'Update Tugas' : 'Tambah Tugas'; ?>
            </button>
        </form>

        <hr>

        <!-- Form untuk Pencarian Tanggal -->
        <form method="POST" class="mb-3">
            <label class="form-label">Urutkan Tanggal</label>
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="oldest" <?php echo $order == 'due_date ASC' ? 'selected' : ''; ?>>Dari Terlama ke Terbaru</option>
                <option value="latest" <?php echo $order == 'due_date DESC' ? 'selected' : ''; ?>>Dari Terbaru ke Terlama</option>
            </select>
        </form>

        <!-- Tabel untuk Menampilkan Daftar Tugas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tasks</td>
                    <td>Priority</td>
                    <td>Tanggal</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['task'] ?></td>
                            <td>
                                <?php 
                                // Menampilkan prioritas tugas
                                if ($row['priority'] == 1) {
                                    echo "tidak penting";
                                } elseif ($row['priority'] == 2) {
                                    echo "penting";
                                } else {
                                    echo "sangat penting";
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // Menghitung sisa waktu hingga tanggal jatuh tempo
                                $due_date = strtotime($row['due_date']);
                                $current_date = strtotime(date('Y-m-d'));
                                $time_diff = $due_date - $current_date;
                                $days_diff = floor($time_diff / (60 * 60 * 24));
                                if ($days_diff > 0) {
                                    echo "Sisa waktu: $days_diff hari";
                                } elseif ($days_diff == 0) {
                                    echo "Hari ini";
                                } else {
                                    echo "Telat: " . abs($days_diff) . " hari";
                                }
                                ?>
                            </td>
                            <td><?php 
                            // Menampilkan status tugas
                            if ($row['status'] == 0) {
                                echo "Belum Selesai";
                            } else {
                                echo "Selesai";
                            }
                            ?>
                            </td>
                            <td>
                                <?php
                                // Menampilkan tombol aksi untuk menyelesaikan, mengedit, atau menghapus tugas
                                if ($row['status'] == 0) { ?>
                                    <a href="task.php?complete=<?php echo $row['id'] ?>" class="btn btn-success">Selesai</a>
                                <?php } ?>
                                <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="task.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("asset/footer.php"); ?> <!-- Menyertakan footer -->
</body>
</html>