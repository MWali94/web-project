<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'dentist_clinic');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required = ['date', 'time', 'reason'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die("Error: Please fill in all required fields.");
        }
    }

    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];
    $patient_id = $_SESSION['patient_id']; 

    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, date, time, reason) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $patient_id, $date, $time, $reason);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        $error = "Booking failed: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Book New Appointment</h2>
        
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST">
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <textarea name="reason" placeholder="Reason for visit" required></textarea>
            <button type="submit">Confirm Booking</button>
        </form>
        
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
