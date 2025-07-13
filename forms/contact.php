<?php
header('Content-Type: application/json');

$receiving_email_address = 'chhaythean.ctrl@gmail.com';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
    exit;
}

$email_subject = "[Contact Form] $subject";
$email_body = "You have received a new message from your website contact form.\n\n" .
    "Name: $name\n" .
    "Email: $email\n" .
    "Subject: $subject\n" .
    "Message:\n$message\n";

$headers = "From: $name <$email>\r\n" .
           "Reply-To: $email\r\n" .
           "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
    echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send email. Please try again later.']);
}
?>
