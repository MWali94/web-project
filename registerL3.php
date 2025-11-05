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
        header("Location: loginL3.php?success=1");
    } else {
        $error = "Registration failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration</title>
    <link rel="stylesheet" href="styleL3.css" />
</head>
<body>
  <header>
  <h1>Patient Registration</h1>
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
    
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="tel" name="phone" placeholder="Phone" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="loginL3.php">Login</a></p>
</body>
</html>