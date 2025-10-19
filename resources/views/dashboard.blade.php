<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Dashboard!</h1>
    <p>You are logged in!</p>
    <nav>
        <a href="/student-records">Student Records</a> | 
        <a href="/courses">Courses</a> | 
        <form method="POST" action="/logout" style="display: inline;">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <button type="submit">Logout</button>
        </form>
    </nav>
</body>
</html>