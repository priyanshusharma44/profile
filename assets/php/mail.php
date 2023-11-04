<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to       = 'serjoramos4444@gmail.com';

    // All form values
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $subject  = $_POST['subject'];
    $msg      = $_POST['msg'];

    // Validate and sanitize inputs
    $name     = htmlspecialchars($name);
    $email    = filter_var($email, FILTER_SANITIZE_EMAIL);
    $subject  = htmlspecialchars($subject);
    $msg      = htmlspecialchars($msg);

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email address
        echo "Invalid email address";
    } else {
        $headers  = 'From: "' . $email . '"';
        $output   = "Name: " . $name . "\nEmail: " . $email . "\nSubject: " . $subject . "\n\nMessage: " . $msg;

        $send     = mail($to, $subject, $output, $headers);

        if ($send) {
            echo 'success';
        } else {
            $error = error_get_last();
            echo 'Error: ' . $error['message'];
        }
        
        
    }
} else {
    // Handle cases where the form is not submitted via POST method
    echo "Invalid form submission.";
}
?>
