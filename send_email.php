<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validate inputs
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($message)) {
        // Limit subject and body to 250 characters
        $subject = substr(filter_var($_POST['subject'], FILTER_SANITIZE_STRING), 0, 250);
        $body = substr($message, 0, 250);

        $to = "your_email@example.com"; // Replace with your email address
        $subjectText = "New message from $name";
        $bodyText = "From: $name\nEmail: $email\nMessage:\n$message";

        // Prevent email header injections
        $headers = "From: $email\r\n" . "Reply-To: $email\r\n";

        if (mail($to, $subjectText, $bodyText, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Oops! Something went wrong.";
        }
    } else {
        echo "Invalid input data.";
    }
}
?>
