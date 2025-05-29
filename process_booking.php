<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name       = $_POST['name'] ?? '';
  $email      = $_POST['email'] ?? '';
  $experience = $_POST['experience'] ?? '';
  $date       = $_POST['date'] ?? '';
  $guests     = $_POST['guests'] ?? '';
  $message    = $_POST['message'] ?? '';

  if ($name && $email && $experience && $date && $guests) {
    $stmt = $conn->prepare("INSERT INTO client_data (name, email, experience, date, guests, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $email, $experience, $date, $guests, $message);

    if ($stmt->execute()) {
      echo "✅ Booking received! We'll contact you shortly.";
    } else {
      echo "❌ Failed to save booking. Please try again.";
    }

    $stmt->close();
  } else {
    echo "❌ Please fill in all required fields.";
  }
}
$conn->close();       
?>
