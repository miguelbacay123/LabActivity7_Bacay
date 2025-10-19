<?php
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;
$student = null;
$courses_stmt = $pdo->query("SELECT * FROM courses");
$courses = $courses_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET name = ?, email = ?, course_id = ? WHERE id = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course_id'],
        $_POST['id']
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Record</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 40px;
        }

        .form-container {
            max-width: 450px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
        }

        button {
            flex: 1;
            padding: 10px;
            margin: 0 5px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button i {
            margin-right: 8px;
        }

        button:hover {
            background-color: #555;
        }

        .save-button {
            background-color: #28a745;
        }

        .save-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Student Record</h2>
        <form method="POST" action="edit.php?id=<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($student['name']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($student['email']) ?>" required>

            <label for="course_id">Course:</label>
            <select name="course_id" id="course_id" required>
                <option value="">Select Course</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= $course['id'] ?>" 
                        <?= ($student['course_id'] == $course['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($course['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="button-group">
                <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>