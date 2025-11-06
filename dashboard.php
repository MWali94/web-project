<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost','root','','dentist_clinic');
$appointments = $conn->query("SELECT * FROM appointments WHERE patient_id = {$_SESSION['patient_id']}");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
     <nav>
       <a href="book.php" class="book-btn">Book New Appointment</a>
     </nav>
    </header>
    <h1>Welcome, <?php echo $_SESSION['patient_name']; ?></h1>
    
    <h2>Your Appointments</h2>
    <?php while ($row = $appointments->fetch_assoc()): ?>
        <p>
            <?php echo $row['date']; ?> at <?php echo $row['time']; ?> - 
            Reason: <?php echo $row['reason']; ?>
        </p>
    <?php endwhile; ?>
    
    <a href="logout.php">Logout</a>
</body>
</html>
