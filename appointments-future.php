<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Future Appointments</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Future Appointments</h1>
    <nav>
      <a href="staff-dashboard.php">Dashboard</a>
    </nav>
  </header>

 

  <footer>
    &copy; 2025 Dental Clinic
  </footer>
</body>
</html>

<?php
$host = 'localhost';
$user = 'root'; 
$pass = '';     
$dbname = 'dentist_clinic';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
session_start();


$today = date('Y-m-d');
$query = "SELECT p.name, a.date, a.time, a.reason 
          FROM appointments a 
          JOIN patients p ON a.patient_id = p.id 
          WHERE a.date >= '$today' ORDER BY a.date ASC";

$result = $conn->query($query);

echo "<h2>Future Appointments</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['name']} - {$row['date']} at {$row['time']} - {$row['reason']}</li>";
}
echo "</ul>";
?>
