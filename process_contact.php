<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        echo "<p style='color:red;'>All fields are required!</p>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format!</p>";
        exit;
    }

    // Email settings
    $to = "ninoolarita63@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "You have received a new message from the contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p style='color:green;'>Thank you, $name! Your message has been sent successfully.</p>";
    } else {
        echo "<p style='color:red;'>Oops! Something went wrong. Please try again later.</p>";
    }
} else {
    echo "<p style='color:red;'>Invalid request method.</p>";
}
?>
