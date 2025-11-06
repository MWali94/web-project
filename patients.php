<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Patients List</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>List of Patients</h1>
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
$result = $conn->query("SELECT * FROM patients");
echo "<h2>Patients</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['name']} - {$row['email']} - {$row['phone']}</li>";
}
echo "</ul>";
?> 
