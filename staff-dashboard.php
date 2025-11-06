<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Staff Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Staff Dashboard</h1>
    <nav>
      <a href="patients.php">List of Patients</a> |
      <a href="appointments-future.php">Future Appointments</a> |
      <a href="appointments-past.php">Past Appointments</a> |
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <div class="container">
    <h2>Welcome, Staff!</h2>
    <p>Select a report from above to view data.</p>
  </div>

  <footer>
    &copy; 2025 Smile Dental Clinic
  </footer>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
  header("Location: staff-login.php");
  exit();
}
?>

