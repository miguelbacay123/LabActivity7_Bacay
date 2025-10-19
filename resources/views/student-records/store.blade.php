<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once 'Student.php';

try {
    $id        = $_POST['id'] ?? '';
    $name      = $_POST['name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $course_id = $_POST['course_id'] ?? '';

    // Check if student ID already exists
    $check_stmt = $pdo->prepare("SELECT id FROM students WHERE id = ?");
    $check_stmt->execute([$id]);
    $existing_student = $check_stmt->fetch();

    if ($existing_student) {
        // Student ID already exists - show error and redirect back
        header('Location: create.php?error=Student+ID+already+exists&id=' . urlencode($id) . '&name=' . urlencode($name) . '&email=' . urlencode($email));
        exit;
    }

    // Get the course name from the course_id for the Student object
    if ($course_id) {
        $stmt = $pdo->prepare("SELECT name FROM courses WHERE id = ?");
        $stmt->execute([$course_id]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        $course_name = $course['name'] ?? '';
    } else {
        $course_name = '';
    }

    $student = new Student($id, $name, $email, $course_name);

    if ($student->isValid()) {
        // Insert new student
        $stmt = $pdo->prepare("INSERT INTO students (id, name, email, course_id, grade) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $student->id,
            $student->name,
            $student->email,
            $course_id,
            $student->grade
        ]);
        header('Location: index.php?success=Student+added+successfully');
        exit;
    } else {
        header('Location: create.php?error=Invalid+student+data');
        exit;
    }
} catch (Exception $e) {
    header('Location: create.php?error=Database+error:+' . urlencode($e->getMessage()));
    exit;
}
?>