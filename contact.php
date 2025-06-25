<?php
// Replace with your actual email address
$to = 'shivanitg09@gmail.com';

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Basic validation
  if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please complete the form and provide a valid email.";
    exit;
  }

  // Build the email content
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n";
  $email_content .= "Subject: $subject\n\n";
  $email_content .= "Message:\n$message\n";

  // Email headers
  $headers = "From: $name <$email>";

  // Send email
  if (mail($to, $subject, $email_content, $headers)) {
    http_response_code(200);
    echo "Message sent successfully.";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
}
?>
