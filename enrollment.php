<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

if (isset($_POST['enroll'])) {
    $student = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "course" => $_POST['course'],
        "date" => date("Y-m-d")
    ];
    $_SESSION['students'][] = $student;
    $message = "Student enrolled successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollment</title>
</head>
<body>
    <h2>Enroll a New Student</h2>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Course: <input type="text" name="course" required><br>
        <input type="submit" name="enroll" value="Enroll">
    </form>

    <h2>Enrolled Students</h2>
    <table border="1">
        <tr>
            <th>Name</th><th>Email</th><th>Course</th><th>Date</th>
        </tr>
        <?php
        foreach ($_SESSION['students'] as $s) {
            echo "<tr>
                    <td>{$s['name']}</td>
                    <td>{$s['email']}</td>
                    <td>{$s['course']}</td>
                    <td>{$s['date']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
