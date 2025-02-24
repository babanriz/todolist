<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'todo');

// Tambah Task
if (isset($_POST['tabah_tugas'])) {
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    if (!empty($task) && !empty($priority) && !empty($due_date)) {
        mysqli_query($koneksi, "INSERT INTO tasks VALUES('', '$task', '$priority', '$due_date', '0')");
        echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Semua Kolom Harus Diisi!'); window.location.href='index.php';</script>";
        exit;
    }
}

// Menandai Task Selesai
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    mysqli_query($koneksi, "UPDATE tasks SET status=1 WHERE id=$id");
    echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php';</script>";
    exit;
}

// Menghapus Task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM tasks WHERE id=$id");
    echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php';</script>";
    exit;
}

// Edit Task
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM tasks WHERE id=$id");
    $task_data = mysqli_fetch_assoc($result);
}

// Update Task
if (isset($_POST['update_task'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    if (!empty($task) && !empty($priority) && !empty($due_date)) {
        mysqli_query($koneksi, "UPDATE tasks SET task='$task', priority='$priority', due_date='$due_date' WHERE id=$id");
        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Semua Kolom Harus Diisi!'); window.location.href='index.php';</script>";
        exit;
    }
}
?>