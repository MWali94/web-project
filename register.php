<?php
$conn = new mysqli('localhost','root','','dentist_clinic');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $stmt = $conn->prepare("INSERT INTO patients (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php?success=1");
    } else {
        $error = "Registration failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
  <h1>Patient Registration</h1>
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
    
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="tel" name="phone" placeholder="Phone" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
