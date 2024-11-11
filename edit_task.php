<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    
    if (!$task) {
        echo "Kegiatan tidak ditemukan!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $status = $_POST['status'];
    $sql = "UPDATE tasks SET task = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $task, $status, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kegiatan</title>
</head>
<body>
    <h1>Edit Kegiatan</h1>
    <form action="edit_task.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        <label>Deskripsi Kegiatan:</label>
        <input type="text" name="task" value="<?php echo $task['task']; ?>" required>
        <br>
        <label>Status:</label>
        <select name="status">
            <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pending</option>
            <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
        </select>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
