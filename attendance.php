<?php
session_start();

if (!isset($_SESSION['attendance'])) {
    $_SESSION['attendance'] = [];
}

if (isset($_POST['mark'])) {
    $record = [
        "student" => $_POST['student'],
        "date" => $_POST['date'],
        "status" => $_POST['status']
    ];
    $_SESSION['attendance'][] = $record;
    $message = "Attendance marked!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
</head>
<body>
    <h2>Mark Attendance</h2>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="POST">
        Select Student:
        <select name="student" required>
            <?php
            if (!empty($_SESSION['students'])) {
                foreach ($_SESSION['students'] as $s) {
                    echo "<option value='{$s['name']}'>{$s['name']} ({$s['course']})</option>";
                }
            } else {
                echo "<option disabled>No students enrolled</option>";
            }
            ?>
        </select><br>

        Date: <input type="date" name="date" required><br>
        Status:
        <select name="status">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select><br>
        <input type="submit" name="mark" value="Mark Attendance">
    </form>

    <h2>Attendance Records</h2>
    <table border="1">
        <tr>
            <th>Student</th><th>Date</th><th>Status</th>
        </tr>
        <?php
        foreach ($_SESSION['attendance'] as $a) {
            echo "<tr>
                    <td>{$a['student']}</td>
                    <td>{$a['date']}</td>
                    <td>{$a['status']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
