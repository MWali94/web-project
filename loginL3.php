<?php
session_start();
$conn = new mysqli('localhost','root','','dentist_clinic');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, name, password FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $patient = $result->fetch_assoc();
        if (password_verify($password, $patient['password'])) {
            $_SESSION['patient_id'] = $patient['id'];
            $_SESSION['patient_name'] = $patient['name'];
            header("Location: dashboardL3.php");
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Patient not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Login</title>
    <link rel="stylesheet" href="styleL3.css" />
</head>
 <header>
 <h1>Patient Login</h1> 
    <nav>
      <a href="indexL3.php">Home</a>
      <a href="bookL3.php">Book Appointment</a>
      <a href="contactL3.php">Contact</a>
      <a href="servicesL3.php">Services</a>
      <a href="staff-loginL3.php">Staff Login</a>
      <a href="registerL3.php">Register</a>
      <a href="loginL3.php">Login</a>
    </nav>
  </header>
 <body>
    
    <?php if (isset($_GET['success'])) echo "<p style='color:green'>Registration successful!</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>New patient? <a href="registerL3.php">Register here</a></p>
</body>
</html>