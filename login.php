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
            header("Location: dashboard.php");
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
    <link rel="stylesheet" href="style.css" />
</head>
 <header>
 <h1>Patient Login</h1> 
    <nav>
      <a href="index.php">Home</a>
      <a href="book.php">Book Appointment</a>
      <a href="contact.php">Contact</a>
      <a href="services.php">Services</a>
      <a href="staff-login.php">Staff Login</a>
      <a href="register.php">Register</a>
      <a href="login.php">Login</a>
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
    <p>New patient? <a href="register.php">Register here</a></p>
</body>
</html>
