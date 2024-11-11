<?php
include 'db.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>
    <h1>Daftar Kegiatan</h1>

    <form action="add_task.php" method="POST">
        <input type="text" name="task" placeholder="Masukkan kegiatan baru" required>
        <button type="submit">Tambah</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['task']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="edit_task.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete_task.php?id=<?php echo $row['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada kegiatan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
