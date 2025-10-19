<?php
require_once '../includes/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM courses");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $error = $_GET['error'] ?? '';
    $success = $_GET['success'] ?? '';

    $prefill_id = $_GET['id'] ?? '';
    $prefill_name = $_GET['name'] ?? '';
    $prefill_email = $_GET['email'] ?? '';
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Student Record</title>
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

        .add-button {
            background-color: #007bff;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            padding: 10px;
            background: #ffe6e6;
            border: 1px solid red;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            text-align: center;
            padding: 10px;
            background: #e6ffe6;
            border: 1px solid green;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="centered-page">
    <div class="form-container">
        <h2>Create Student Record</h2>
        
        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <form action="store.php" method="POST">
            <label for="id">ID Number:</label>
            <input type="text" name="id" id="id" value="<?= htmlspecialchars($prefill_id) ?>" required>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($prefill_name) ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($prefill_email) ?>" required>

            <label for="course_id">Course:</label>
            <select name="course_id" id="course_id" required>
                <option value="">Select Course</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= $course['id'] ?>">
                        <?= htmlspecialchars($course['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="button-group">
                <button type="submit" class="add-button">
                    <i class="fas fa-user-plus"></i> Add Student
                </button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
} catch (Exception $e) {
    echo "<div style='color: red; text-align: center;'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>