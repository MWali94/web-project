<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Staff Login</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Staff Login</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="staff-login.php">Staff Login</a>
    </nav>
  </header>

  <div class="container">

  <form  method="POST">

  <input type="text" name="username" required placeholder="Username" />
  <input type="password" name="password" required placeholder="Password" />
  <button type="submit">Login</button>
  </form>

  </div>

  <footer>
    &copy; 2025 Smile Dental Clinic
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM staff WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (hash('sha256', $password) === $hashed_password) {
        $_SESSION['staff_id'] = $id;
        header("Location: staff-dashboard.php");
    } else {
        echo "Invalid login.";
    }
    $stmt->close();
}
?>
